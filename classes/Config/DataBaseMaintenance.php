<?php

namespace Config;

use Util\JsonHandler;
use util\DB;
use Util\ReportHandler;

/**
 * DataBaseMaintenance
 * 
 * @author Bata Jozsef  
 * 
 */
class DataBaseMaintenance
{
    use JsonHandler;
    use ReportHandler;
    /**
     * @var array
     */
    protected array  $dataStructure = [];

    /**
     * @var array
     */
    protected array  $modelList = [];

    /**
     * @var string
     */
    protected $sqlCreateFile;

    /**
     * @var array
     */
    protected $log = [];

    /**
     * @var DB
     */
    protected DB $db;

    /**
     * @var bool - if true 
     */
    protected $execute = false;

    /**
     * __construct
     *
     * @param  bool $execute
     * @return void
     */
    public function __construct(bool $execute = false)
    {
        $this->execute = $execute;

        $this->db = DB::getInstance(false); // no transactions here
        $this->sqlCreateFile = LOGDIR . "testCreateDatabase.sql";
        file_put_contents($this->sqlCreateFile, '');
        $this->loadDataStructure();
    }

    /**
     * getModelList
     *
     * @return array
     */
    public function getModelList(): array
    {
        return $this->modelList;
    }

    /**
     * loadDataStructure
     *
     * @return void
     */
    protected function loadDataStructure()
    {
        $dataStructure = $this->getJsonFromFile('config/dataStructure.json');

        $modelList = $dataStructure['modelList'] ?? [];

        $defaultDbSettings = $dataStructure['dbSettings'] ?? [];

        foreach ($modelList as $modelName => $modelDbSettings) {
            $modelSettings = $this->getJsonFromFile('config/sqlModels/' . $modelName . '.json') ?? [];

            $modelSettings['dbsettings'] = array_merge($defaultDbSettings, $modelDbSettings);

            $this->modelList[$modelName] = $modelSettings;

            $this->addReport("Modell loaded: {$modelName}");
        }
    }


    /**
     * dropAllTables
     *
     * @return void
     */
    public function dropAllTables()
    {

        try {


            // create list containing DROP statement for all foreign-key reference constraints
            // ( would disable table-drop statemens)
            $databaseName = $this->db->getDatabaseName();

            $sql = "
            SELECT concat('ALTER TABLE ', TABLE_NAME, ' DROP FOREIGN KEY ', CONSTRAINT_NAME, ';') 
                FROM information_schema.key_column_usage 
                WHERE CONSTRAINT_SCHEMA = '{$databaseName}'  AND referenced_table_name IS NOT NULL;
        ";

            $result = $this->db->query($sql);

            foreach ($result as $sqlRow) {
                $sqlLine = reset($sqlRow) ?? '';
                $this->executeQuery($sqlLine);
            }

            foreach ($this->modelList as $modelName => $modelSettings) {
                $this->dropTable($modelName);
            }
        } catch (\Exception $e) {

            $this->addReport("dropAllTables error : " . $e->getMessage(), "error");
            $this->log($e->getMessage());
        }
    }


    /**
     * dropTable
     *
     * @param  string $modelName
     * @return void
     */
    public function dropTable(string $modelName)
    {
        $tableName = $this->getTableName($modelName);
        $this->executeQuery("DROP TABLE if exists {$tableName} ; ");
    }


    /**
     * createTables
     *
     * @return void
     */
    public function createTables()
    {
        try {

            foreach ($this->modelList as $modelName => $modelSettings) {
                $createStatement = $this->renderCreateStatement($modelName);
                $this->executeQuery($createStatement);
            }
        } catch (\Exception $e) {
            $this->addReport("createTables error : " . $e->getMessage(), "error");
            $this->log($e->getMessage());
        }
    }

    /**
     * renderCreateStatement
     * for MySql - here we have to replace if postgres or any other
     *
     * @param  string $modelName
     * @return string - sql create statement for the model-table
     */
    protected function renderCreateStatement(string $modelName): string
    {
        $settings = $this->modelList[$modelName] ?? [];
        $tableName = $this->getTableName($modelName);

        $fields = $settings['fields'] ?? [];
        $contstraints = [];
        $foreignKeyContstraints = [];

        $sql = "CREATE TABLE `{$tableName}` (";
        foreach ($fields as $fieldName => $fieldSettings) {

            $fieldType = $fieldSettings['type'] ?? 'string';

            if (isset($fieldSettings['reference'])) {
                $fieldType = $fieldSettings['type'] ?? 'integer';
            } 

            $required = $fieldSettings['required'] ?? false;
            $default = $this->getDefaultValueRendered($fieldSettings['default'] ?? null);
            // $referenceDataModel = $fieldSettings['reference'] ?? '';

            $reference = $this->getReference($tableName, $fieldName, $fieldSettings);

            if ($reference) {                
                $fieldType = $reference['referenceIdType'];
                $referenceName = $reference['referenceName'];
                $referenceIdFieldName = $reference['referenceIdFieldName'];
                $referencedTableName = $reference['referencedTableName'];

                $foreignKeyContstraints[$referenceName]['fieldList'][$fieldName] = $referenceIdFieldName;
                $foreignKeyContstraints[$referenceName]['referencedTableName'] = $referencedTableName;
            }


            $suffix = "";

            $sql .= "\n\t`{$fieldName}` ";
            switch ($fieldType) {
                case "autointeger":
                    $len = $fieldSettings['len']  ?? '11';
                    $sql .= "INT({$len})";
                    $required = true;
                    $suffix .= " AUTO_INCREMENT ";
                    break;
                case 'createdby':
                    $sql .= "INT(11)";
                    break;
                case 'modifiedby':
                    $sql .= "INT(11)";
                    break;
                case 'createdat':
                    $sql .= "DATETIME";
                    $default = "CURRENT_TIMESTAMP";
                    break;
                case 'modifiedat':
                    $sql .= "DATETIME";
                    $default = "CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
                    break;
                case "json":
                    $sql .= "JSON";
                    break;
                case "text":
                    $sql .= "TEXT";
                    break;
                case "autocounter":
                case "string":
                    $len = $fieldSettings['len']  ?? '100';
                    $sql .= "VARCHAR({$len})";
                    break;
                case "integer":
                    $len = $fieldSettings['len']  ?? '11';
                    $sql .= "INT({$len})";
                    break;
                case "decimal":
                    $len = $fieldSettings['len']  ?? '11';
                    $decimals = $fieldSettings['decimals']  ?? '2';
                    $sql .= "DECIMAL({$len},{$decimals})";
                    break;
                case "float":
                    $len = $fieldSettings['len']  ?? '13';
                    $decimals = $fieldSettings['decimals']  ?? '8';
                    $sql .= "FLOAT({$len},{$decimals})";                    
                    break;                    
                case "password":
                    $len = $fieldSettings['len']  ?? '260';
                    $sql .= "VARCHAR({$len})";
                    break;
                case "email":
                    $len = $fieldSettings['len']  ?? '100';
                    $sql .= "VARCHAR({$len})";
                    // if needed replace here for integer+reference to the email model
                    break;
                case "date":
                    $sql .= "DATE";
                    break;
                case "datetime":
                    $sql .= "DATETIME";
                    break;
                case "point":
                    $sql .= "POINT";
                    break;
                case "bool":
                case "boolean":
                    $sql .= "BOOL";
                    break;

                default:
                    throw new \Exception("Field: {$fieldName} : type [{$fieldType}] not implemented");;
            }

            $sql .= $suffix;



            // adding NOT NULL if needed
            if ($required) {
                $sql .= " NOT NULL ";
            }

            // adding default value if needed
            if ($default) {
                $sql .= " DEFAULT {$default} ";
            }

            $sql .= ' ,';
        }

        $idList = $settings['idfields'] ?? [];
        $sql .= "\n\tPRIMARY KEY (`" . implode('`,`', $idList) . "`)";

        // add foerign key contraitnts
        // foreach ($contstraints as $contstraint) {
        //     $sql .= "\n\t,{$contstraint}";
        // }
        foreach ($foreignKeyContstraints as $constraintName => $constraintSettings) {
            $fieldList = $constraintSettings['fieldList'] ?? [];

            $fieldNames = implode(',', array_keys($fieldList));
            $referencedIdFieldNames = implode(',', array_values($fieldList));
            $referencedTableName = $constraintSettings['referencedTableName'];

            $sql .= "\n\t,CONSTRAINT {$constraintName} FOREIGN KEY ($fieldNames) REFERENCES {$referencedTableName}({$referencedIdFieldNames}) ";
        }

        // TODO: add  ENGINE=INNODB AUTO_INCREMENT=0 DEFAULT CHARSET=LATIN1   from tabledefinition;
        $sql .= "\n);\n\n";  

        return $sql;
    }

    /**
     * getRreferenceTableName
     *
     * @param  string $referenceDataModel
     * @return void
     */
    protected function getRreferenceTableName(string $referenceDataModel)
    {
        $modelSettings = $this->getJsonFromFile('config/sqlModels/' . $referenceDataModel . '.json', false);
        $tableName = $modelSettings['tablename'] ?? 'error_' . $referenceDataModel;
        return $tableName;
    }

    /**
     * getReferenceDataModelIdFields
     *
     * @param  string $referenceDataModelName
     * @return array
     */
    protected function getReference(string $tableName, string $fieldName, array $fieldSettings): array|bool
    {

        $referenceDataModelName = $fieldSettings['reference'] ?? '';

        $fieldType = $fieldSettings['type'] ?? '';
        
        if ($fieldType == 'createdby' or $fieldType === 'modifiedby') {
            $referenceDataModelName = "User";
        }

        if (empty($referenceDataModelName)) {
            return false;
        }



        $dataModel = $this->modelList[$referenceDataModelName] ?? false;

        if ($dataModel === false) {
            throw new \Exception("Referenced datamodel not found:{$referenceDataModelName}");
        }


        $referencedTableName = $dataModel['tablename'];
        $referencedIdFieldName = $fieldSettings['referenceid'] ?? '';     
        
        
        // $referenceName = $fieldSettings['referencename'] ?? "fk_{$tableName}_{$referencedTableName}_{$fieldName}_{$referencedIdFieldName}";

        $reference = [
            'referencedTableName' => $referencedTableName,
            "referenceIdType" => "",
            "referenceIdFieldName" => "",
            "referenceName" => "",
        ];


        foreach ($dataModel['idfields'] as $idFieldName) {
            $referencedFieldType = $dataModel['fields'][$idFieldName]['type'] ?? "integer";
            $this->addReport("referencedIdField: {$idFieldName}" . implode(',', $dataModel['fields'][$idFieldName]));

            $referencedFieldType = ($referencedFieldType == 'autointeger' ? 'integer' : $referencedFieldType);

            // if no specification which id field  targeted then the first (we hope the only one..)
            if (empty($referencedIdFieldName) or $referencedIdFieldName === $idFieldName) {
                $reference['referenceIdType'] = $referencedFieldType;
                $reference['referenceIdFieldName'] = $idFieldName;
                $reference['referenceName'] = $fieldSettings['referencename'] ?? "fk_{$tableName}_{$referencedTableName}_{$fieldName}_{$idFieldName}";;
                return $reference;
            }
        }

        throw new \Exception("Referenced id-field error");
    }


    /**
     * getDefaultValueRendered
     *
     * @param  mixed $value
     * @return void
     */
    protected function getDefaultValueRendered($value)
    {
        $valueRendered = '';
        switch (gettype($value)) {
            case 'boolean':
                $valueRendered = ($value ? "'1'" : "'0'");
                break;
            case 'string':
                $valueRendered = "'{$value}'";
                break;
            case 'integer':
            case 'double':
                $valueRendered = "{$value}";
                break;
            case 'NULL':
                // $valueRendered = "NULL";
                $valueRendered = "";  // DEFAULT NULL is not really necessary..
                break;
            default:
                $valueRendered = "''";
        }
        return $valueRendered;
    }


    /**
     * executeQuery
     *
     * @param  string $query
     * @return void
     */
    protected function executeQuery(string $query)
    {

        if ($this->execute) {
            try {
                $this->logQuery($query);
                $this->addReport($query, "sql");

                $this->db->executeQuery($query);
            } catch (\Exception $e) {
                $this->addReport("SQL query error:" . $e->getMessage(), "error");
                $this->logQuery("ERROR:" . $e->getMessage());
                $this->log("ERROR:" . $e->getMessage());
            }
        }
    }

    /**
     * logQuery
     *
     * @param  string $content
     * @param  bool $newLine
     * @return void
     */
    protected function logQuery(string $content, bool $newLine = true)
    {
        file_put_contents($this->sqlCreateFile, ($newLine ? "\n" : "") . $content, FILE_APPEND);
    }

    /**
     * log
     *
     * @param  string $content
     * @return void
     */
    protected function log(string $content)
    {
        $this->log[] = $content;
    }

    /**
     * writeLog
     *
     * @param  string $fileName
     * @return void
     */
    public function writeLog(string $fileName = LOGDIR . 'sqlquery.log')
    {
        $content = implode("\n", $this->log);
        file_put_contents($fileName, $content);
    }

    /**
     * getLogs
     *
     * @param  bool $htmlFormatted
     * @return void
     */
    public function getLogs(bool $htmlFormatted = false)
    {
        if ($htmlFormatted) {
            $logHtml = "<pre>";
            $logHtml .= implode("\n", $this->log);
            $logHtml = "</pre>";
            return $logHtml;
        } else {
            return $this->log;
        }
    }


    /**
     * getTableName
     *
     * @param  string $modelName
     * @return string
     */
    public function getTableName(string $modelName): string
    {
        $tableName = $this->modelList[$modelName]['tablename'] ?? '';
        if (empty($tableName)) {
            throw new \Exception("getTableName {$modelName} error");
        }
        return $tableName;
    }
}
