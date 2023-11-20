<?php

namespace DataModel;

use Exceptions\RestApiException;

/**
 * 
 */
class JsonModel extends DataModel
{

    protected $data; // the json content in memory
    protected $dirty = false; // true if modified but not saved
    protected $jsonDataStorage = 'data';
    protected $jsonDataFilePath = '';

    /**
     * 
     * @param string $modelName
     */
    public function __construct(string $modelName)
    {
        // load records from json
        parent::__construct($modelName);

        // loading data part to memory:
        $this->jsonDataFilePath = $this->jsonDataStorage . '/' . $this->modelName . 'Data.json';
        $this->loadDataFromnJson();
    }

    /**
     * 
     * @param array $parameters
     * @return array
     * @throws RestApiException
     */
    public function processGetRecord(array $parameters = []): array
    {
        $record = [];
        $id = $this->getid($parameters);

        if (!isset($this->data[$id]))
        {
            throw new RestApiException('record not found', 404, []);
        }

        $row = $this->data[$id];
        foreach ($this->fieldList as $fieldName => $fieldProps)
        {
            $record[$fieldName] = $row[$fieldName] ?? $fieldProps['default'] ?? '';
        }

        return $record;
    }

    public function processGetList(array $parameters = []): array
    {
        $recordList = [];
        foreach ($this->data as $id => $record)
        {
            $record = [];

            $row = $this->data[$id];
            foreach ($this->fieldList as $fieldName => $fieldProps)
            {
                $record[$fieldName] = $row[$fieldName] ?? $fieldProps['default'] ?? '';
            }
            $needed = $this->compare($record, $parameters);
            if ($needed)
            {
                $recordList[] = $record;
            }
        }

        return $recordList;
    }

    public function processInsertRecord(array $parameters = []): array
    {
        $record = [];
        $id = $this->getid($parameters);
        if (isset($this->data[$id]))
        {
            throw new RestApiException('id exists', 401);
        }

        foreach ($this->fieldList as $fieldName => $field)
        {
            /* @var $field BasefieldType */
            if (!$field->isRequiredFullfilled($parameters[$fieldName], 'insert'))
            {
                throw new RestApiException("Field {$fieldName} is required");
            }
            $record[$fieldName] = $parameters[$fieldName] ?? $field->getDefaultValue();
        }

        // todo validate !

        $this->data[$id] = $record;
        $this->saveDataToJson();
        return $record;
    }

    public function processUpdateRecord(array $parameters = []): array
    {
        $id = $this->getId($parameters);
        if (!isset($this->data[$id]))
        {
            throw new RestApiException('record not found', 404);
        }

        foreach ($this->fieldList as $fieldName => $fieldProps)
        {
            if (in_array($fieldName, $this->idFields))
                continue;


            $record[$fieldName] = $parameters[$fieldName] ?? '';

            if ($fieldProps['required'] and empty($parameters[$fieldName]))
            {
                throw new RestApiException("Field {$fieldName} is required");
            }
                    }

        // todo validate !

        $this->data[$id] = $record;
        $this->saveDataToJson();
        return [];
    }

    public function processDeleteRecord(array $parameters = []): array
    {
        $record = [];
        $id = $this->getid($parameters);
        if (!isset($this->data[$id]))
        {
            throw new RestApiException('record not found', 404, []);
        }

        $row = $this->data[$id];
        foreach ($this->fieldList as $fieldName => $fieldProps)
        {
            $record[$fieldName] = $row[$fieldName] ?? '';
        }
        unset($this->data[$id]);
        $this->saveDataToJson();
        return $record;
    }

    protected function getId(array $parameters = [])
    {
        $structuredId = '';
        foreach ($this->idFields as $idFieldNamePart)
        {
            $structuredId .= ( ($structuredId ? '|' : '') . $parameters[$idFieldNamePart] );
        }
        return $structuredId;
    }

    /**
     * 
     */
    protected function loadDataFromnJson()
    {
        $this->data = $this->getJsonFromFile($this->jsonDataFilePath);
        $this->dirty = false;
    }

    /**
     * 
     * @return boolean
     */
    protected function saveDataToJson()
    {
        $this->putJsonToFile($this->data, $this->jsonDataFilePath);
        $this->dirty = false;
        return true;
    }

    protected function compare($record, $parameters)
    {
        foreach ($parameters as $key => $value)
        {

            if (!isset($this->fieldList[$key]))
            {
                throw new RestApiException('Error in filterparameters:' . $key);
            }

            $fieldValue = $record[$key] ?? '';

            $value = str_replace('%', '*', $value);
            if (!fnmatch($value, $fieldValue))
            {
                return false;
            }
        }
        return true;
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
        // TODO implement this:
        // go through $this->data  get the highest value
        return 0;
    }

}
