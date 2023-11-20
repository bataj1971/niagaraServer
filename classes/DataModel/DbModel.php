<?php

namespace DataModel;

use Util\DB;
use Exceptions\RestApiException;

/**
 * Description of DbModel
 *
 * @author Bata Jozsef 
 */
class DbModel extends DataModel
{

    /** @var mixed $db */
    protected DB $db;

    /** @var mixed $tableName */
    protected string $tableName;

    /**
     * in case of put/delete records previous state before modification
     * @var array
     */
    protected ?array $currentRecordData = null;

    /**
     * __construct
     *
     * @param  string $modelName
     * @return void
     */
    public function __construct(string $modelName)
    {
        parent::__construct($modelName);
        $this->db = DB::getInstance();
        $this->tableName = $this->settings['tablename'];
    }

    /**
     * processDeleteRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function processDeleteRecord(array $parameters = []): array
    {
        $tablename = $this->tableName;
        $fieldValueList = '';

        $where = $this->getWhereExpression($parameters);
        $whereExpression = $where['whereExpression'];
        $values = $where['values'];

        $sql = "DELETE FROM {$tablename} WHERE ({$whereExpression})  ";
        $deletedRows = $this->db->runDeleteQuery($sql, $values);

        if ($deletedRows == 0) {
            throw new RestApiException("Record not found", 404);
        }
        return ['deletedrows' => $deletedRows];
    }

    /**
     * processGetList
     *
     * @param  array $parameters
     * @return array
     */
    public function processGetList(array $parameters = []): array
    {
        $values = [];
        $whereCondition = "";
        $limitExpression = "";
        $offsetExpression = "";
        $orderByExpression = "";

        foreach ($parameters as $key => $value) {
            switch (strtolower($key)) {
                case 'limit':
                    $limitValue = (int) $value;
                    if ($limitValue > 0) {
                        $limitExpression = "\n      LIMIT $limitValue";
                        // $values[":{$key}"] = $limitValue;
                    } else {
                        throw new RestApiException("Invalid LIMIT value:{$value}");
                    }
                    break;
                case 'offset':
                    $offsetValue = (int) $value;
                    if ($offsetValue > 0) {
                        $offsetExpression = "\n      OFFSET $offsetValue";
                        // $values[":{$key}"] = $offsetValue;
                    } else {
                        throw new RestApiException("Invalid OFFSET value:{$value}");
                    }
                    break;
                case 'sort_by':
                    $orderExpression = '';
                    $sortParts = explode(',', $value);

                    foreach ($sortParts as $sortPart) {
                        $parts = explode(':', $sortPart);
                        $fieldName = $part[0] ?? '';
                        $direction = strtolower($part[1] ?? '');
                        $direction = ($direction == 'desc' ? 'desc' : 'asc');
                        if (isset($this->fieldList[$fieldName])) {
                            $orderExpression .= ($orderExpression ? ',' : '') . "$fieldName $direction ";
                        } else {
                            throw new RestApiException("Error in sort_by :{$fieldName}", 403);
                        }
                    }
                    $orderByExpression = "\n      ORDER BY $orderExpression";

                    break;

                default:
                    $fieldName = $key;
                    if (!str_contains($fieldName,'.')){
                        $fieldName = $this->tableName.".". $fieldName;
                    }
                    $whereCondition .= ($whereCondition ? ' AND ' : '') . " {$fieldName} like :{$key}";
                    $values[":{$key}"] = $value;
                    break;
            }
        }


        $joinList = $this->getRenderedQueryJoin();
        $fieldList = $this->getQueryFieldListRendered();

        $sql = "SELECT {$fieldList} FROM " . $this->tableName;
        $sql .= ($joinList ? $joinList : "");
        $sql .= ($whereCondition ? " WHERE {$whereCondition}" : "");
        $sql .= ($orderByExpression ? $orderByExpression : "");
        $sql .= ($limitExpression ? $limitExpression : "");
        $sql .= ($offsetExpression ? $offsetExpression : "");

        $recordSet = $this->db->query($sql, $values);
        $recordSet = $this->prepareRowRecordSet($recordSet);
        return $recordSet;
    }

    /**
     * prepareRowRecordSet
     *
     * @param  mixed $recordSet
     * @return array
     */
    protected function prepareRowRecordSet($recordSet): array
    {

        foreach ($recordSet as &$record) {
            $record = json_decode($record['jsonData'], true);
        }

        return $recordSet;
    }

    /**
     * processInsertRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function processInsertRecord(array $parameters = []): array
    {
        $tablename = $this->tableName;
        $fieldList = '';
        $valueList = '';
        $values = [];
        foreach ($this->fieldList as $fieldName => $field) { /* @var $field BaseFieldType */
            if (!$field->processInsert())
                continue;
            if (!isset($parameters[$fieldName]))
                continue;

            $fieldValue = $parameters[$fieldName] ?? '';
            $fieldList .= ($fieldList ? ', ' : ' ') . "$fieldName";
            $valueList .= ($valueList ? ' ,' : '') . ":{$fieldName}";
            $values[':' . $fieldName] = $field->prepareValueForQuery($fieldValue);
        }
        $sql = "INSERT INTO $tablename ($fieldList) VALUES ($valueList)  ";

        // TODO:  if idfield is not autointeger, get the id values from the field data and return as $newId
        $autoIncrementalId = $this->db->runInsertQuery($sql, $values);

        return $this->getIdNameValuePairs($parameters, $autoIncrementalId); // ['id' => $newId];
    }

    /**
     * processUpdateRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function processUpdateRecord(array $parameters = []): array
    {
        $tablename = $this->tableName;
        $fieldValueList = '';

        $where = $this->getWhereExpression($parameters);
        $whereExpression = $where['whereExpression'];
        $values = $where['values'];

        foreach ($this->fieldList as $fieldName => $field) { /* @var $field BaseFieldType */

            if ($field->isAuto())
                continue;
            if (!$field->processUpdate())
                continue;
            if (!isset($parameters[$fieldName]))
                continue;
            // todo if idfield continue
            if ($field->isIdField()) {
                continue;
            }

            $fieldValue = $parameters[$fieldName] ?? '';
            $fieldValueList .= ($fieldValueList ? ', ' : ' ') . " {$fieldName} = :{$fieldName} ";
            $values[':' . $fieldName] = $field->prepareValueForQuery($fieldValue);
        }

        $sql = "UPDATE {$tablename} SET $fieldValueList WHERE ({$whereExpression})  ";
        $updatedRows = $this->db->runUpdateQuery($sql, $values);
        if ($updatedRows == 0) {
            throw new RestApiException("Record not found", 404);
        }

        return ['updatedrows' => $updatedRows];
    }

    /**
     * processGetRecord
     *
     * @param  array $parameters
     * @return array
     */
    protected function processGetRecord(array $parameters = []): array
    {
        $where = $this->getWhereExpression($parameters);
        $whereExpression = $where['whereExpression'];
        $values = $where['values'];
        $joinList = $this->getRenderedQueryJoin();
        $fieldList = $this->getQueryFieldListRendered();


        $sql = "SELECT {$fieldList} FROM {$this->tableName} {$joinList} WHERE {$whereExpression} LIMIT 2";
        $recordSet = $this->db->query($sql, $values);
        $recordSet = $this->prepareRowRecordSet($recordSet);

        if (count($recordSet) == 1) {
            $record = reset($recordSet);
            return $record;
        } elseif (count($recordSet) == 0) {
            $idWhere = str_replace(array_keys($values), array_values($values), $whereExpression);
            throw new RestApiException("Record not found:" . $this->modelName . ':' . $idWhere, 404);
        } else {
            throw new RestApiException("Ambigous - multiple records found", 502);
        }
    }

    /**
     * * Create the "where id = 'idvalue' part of sql insert/update expression,  
     *          there can be more then one id-field
     * @param array $data - fieldvalues, must contain the id- key-value pair(s) 
     * @return array
     * @throws Exception
     */
    protected function getWhereExpression(array $data = []): array
    {
        $where = "";
        $values = [];
        if (is_array($data)) {
            foreach ($this->idFields as $idfield) {

                $where .= ($where ? " AND " : " ") . "  {$this->tableName}.{$idfield} = :{$idfield}";
                $values[":{$idfield}"] = $data[$idfield];
            }
        } else {  // not an array
            $first = true;
            foreach ($this->idFields as $idfield) {
                // $where .= ($where ? " AND " : " ") . "{$this->tableName}.{$idfield} =" . $this->db->clean($data) . " ";

                $where .= ($where ? " AND " : " ") . " {$this->tableName}.{$idfield} = :{$idfield}";
                $values[":{$idfield}"] =  $data;

                if (!$first) {
                    throw new RestApiException("table has more id fields, only whereExpression fx got only one value ");
                }
                $first = false;
            }
        }
        return ["whereExpression" => $where, "values" => $values];
    }

    /**
     * getIdNameValuePairs
     *
     * @param  array $parameters
     * @param  int $autoIncrementValue
     * @return array
     */
    protected function getIdNameValuePairs(array $parameters = [], int $autoIncrementValue = 0): array
    {
        $idValues = [];
        if (is_array($parameters)) {
            foreach ($this->idFields as $idFieldName) {
                /** @var $idfield string */
                /** @var $field FieldType */
                $field = $this->fieldList[$idFieldName];
                if ($field->getType() === 'autointeger') {
                    $idValues[$idFieldName] = $autoIncrementValue;
                } else {
                    $idValues[$idFieldName] = $parameters[$idFieldName];
                }
            }
        }
        return $idValues;
    }

    /**
     * 
     * @param string $fieldName
     * @param int $prefixLen
     * @param int $counterLength
     * @param array $record
     * @param array $scopeFields
     * @return int
     */
    public function getLastCounterValue(string $fieldName, int $prefixLen, int $counterLength, array $record, array $scopeFields = []): int
    {
        $sql = "SELECT MAX(SUBSTRING( {$fieldName} ,{$prefixLen} + 1, {$counterLength})) FROM {$this->tableName} ";

        $values = [];
        if ($scopeFields) {
            $scopeWhereExpression = '';
            foreach ($scopeFields as $scopeField) {
                $scopeWhereExpression .= ($scopeWhereExpression ? ' AND ' : ' ') .
                    " {$scopeField} = :$scopeField";
                $values[":{$scopeField}"] = $record[$scopeField];
            }
            $sql .= " WHERE " . $scopeWhereExpression;
        }


        $lastCustomId = $this->db->getFirstValue($sql, $values);
        if ($lastCustomId) {
            $idCounter = (int) $lastCustomId;
        } else {
            $idCounter = 0;
        }

        return $idCounter;
    }

    /**
     * 
     * @param type $param
     * @return type
     * @throws RestApiException
     */
    protected function getCurrentRecordData(array $parameters = [])
    {
        if ($this->currentRecordData) {
            return $this->currentRecordData;
        }

        $where = $this->getWhereExpression($parameters);
        $whereExpression = $where['whereExpression'];
        $values = $where['values'];

        $feildList = $this->getQueryFieldList();

        $sql = "SELECT $feildList FROM {$this->tableName} WHERE {$whereExpression}";
        $recordSet = $this->db->query($sql, $values);

        if (count($recordSet) == 1) {
            $record = reset($recordSet);
        } elseif (count($recordSet) == 0) {
            throw new RestApiException("Record not found", 404);
        } else {
            throw new RestApiException("Ambigous Record not found", 502);
        }

        $this->currentRecordData = $record;
        return $record;
    }


    /**
     * getQueryFieldList
     *
     * @return void
     */
    protected function getQueryFieldListRendered(): string
    {

        $fieldList = $this->getQueryFieldList();

        $renderedFieldExpressions = [];
        foreach ($fieldList as $fieldName => $valueExpression) {
            $renderedFieldExpressions[] = "\n\t'{$fieldName}',{$valueExpression}";
        }

        $fieldListQuery = "\nJSON_OBJECT(" . implode(',', $renderedFieldExpressions) . " \n) as jsonData";

        return $fieldListQuery;
    }

    /**
     * override this if spec fields sould be added
     * getQueryFieldList
     *
     * @return array
     */
    protected function getQueryFieldList(): array
    {
        $fieldList = [];
        foreach ($this->fieldList as $fieldName => $fieldProps) {
            // TODO:
            // if field is a reference, do some automatical extension
            $fieldValueExpression =            "{$this->tableName}.{$fieldName}";
            $fieldList[$fieldName] = $fieldValueExpression;
        }

        if (isset($this->fieldList['modified_by'])) {
            $fieldList['modified_by_user'] = "
            JSON_OBJECT(
				'id',modified_by_user.id,
				'name',modified_by_user.name,
				'email',modified_by_user.email
				)            
        ";        


        }
        if (isset($this->fieldList['created_by'])) {
            $fieldList['created_by_user'] = "
            JSON_OBJECT(
				'id',created_by_user.id,
				'name',created_by_user.name,
				'email',created_by_user.email
				)            
        ";        

        }


        return $fieldList;
    }

    /**
     * getQueryJoin
     *
     * @return array
     */
    protected function getQueryJoin(): array
    {
        $joinList = [];
        if (isset($this->fieldList['modified_by'])) {
            $joinList ['modified_by'] = "JOIN users as modified_by_user ON modified_by_user.id = {$this->tableName}.modified_by ";
        }
        if (isset($this->fieldList['created_by'])) {
            $joinList['created_by'] = "JOIN users as created_by_user ON created_by_user.id = {$this->tableName}.created_by ";
        }
        return $joinList;
    }
    
    /**
     * getRenderedQueryJoin
     *
     * @return string
     */
    protected function getRenderedQueryJoin():string {
        $joinList = $this->getQueryJoin();
        
        $renderedQueryJoin = "";

        foreach($joinList as $joinExpression ){
            $renderedQueryJoin .= "\n\t{$joinExpression}";
        }

        return $renderedQueryJoin;

    }
}
