<?php

namespace DataModel;

use Util\JsonHandler;
use Exceptions\RestApiException;


/**
 * Description of Model
 *
 * @author Bata Jozsef 
 */
abstract class DataModel
{

    use JsonHandler;
    
    /** @var array $settings */
    protected Array $settings;    

    /** @var string $modelName */
    protected string $modelName;    

    /** @var array $fieldList */
    protected Array $fieldList = [];    

    /** @var mixed $idFields */
    protected Array $idFields = [];

    protected static $instances = [];    
    /**
     * __construct
     *
     * @param  string $modelName
     * @return void
     */
    function __construct(string $modelName)
    {
        $this->loadFieldStructure($modelName);
    }

    public static function getInstance(string $modelName = null): static    
    {
        if (empty($modelName)){
            $modelName = substr(self::class,0,-5);
        }
        if (!isset(static::$instances[$modelName])) {
            static::$instances[$modelName] = new static($modelName);
        }

        return static::$instances[$modelName];
    }
    /**
     * 
     * @param string $modelName
     * @return void
     */
    protected function loadFieldStructure(string $modelName): void
    {
        $this->modelName = $modelName;

        $this->settings = $this->getJsonFromFile('config/sqlModels/' . $modelName . '.json');
        $fields = $this->settings['fields'] ?? [];
        $this->idFields = $this->settings["idfields"] ?? [];
        foreach ($fields as $fieldName => $fieldProps)
        {
            $fieldProps['name'] = $fieldName;
            $field = BaseFieldType::getFieldTypeInstance($fieldProps, $this);

            $this->fieldList[$fieldName] = $field;
        }
        

    }
    
    /**
     * processInsertRecord
     *
     * @param  array $parameters
     * @return array
     */
    abstract protected function processInsertRecord(array $parameters = []): array;
    
    /**
     * processUpdateRecord
     *
     * @param  array $parameters
     * @return array
     */
    abstract protected function processUpdateRecord(array $parameters = []): array;
    
    /**
     * processDeleteRecord
     *
     * @param  array $parameters
     * @return array
     */
    abstract protected function processDeleteRecord(array $parameters = []): array;
    
    /**
     * processGetRecord
     *
     * @param  array $parameters
     * @return array
     */
    abstract protected function processGetRecord(array $parameters = []): array;
    
    /**
     * processGetList
     *
     * @param  array $parameters
     * @return array
     */
    abstract protected function processGetList(array $parameters = []): array;
    
    /**
     * insertRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function insertRecord(array $parameters = []): array
    {
        $parameters = $this->setRecord($parameters, 'insert');
        $record = $this->processInsertRecord($parameters);

        return $record;
    }
    
    /**
     * updateRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function updateRecord(array $parameters = []): array
    {
        $parameters = $this->setRecord($parameters, 'update');
        $this->validate($parameters, 'update');
        $record = $this->processUpdateRecord($parameters);

        return $record;
    }
    
    /**
     * deleteRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function deleteRecord(array $parameters = []): array
    {
        $this->validate($parameters, 'delete');
        return $this->processDeleteRecord($parameters);
    }
    
    /**
     * getRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function getRecord(array $parameters = []): array
    {
        return $this->processGetRecord($parameters);
    }
    
    /**
     * getList
     *
     * @param  array $parameters
     * @return array
     */
    public function getList(array $parameters = []): array
    {

        return $this->processGetList($parameters);
    }

    /**
     * setRecord
     *
     * @param  mixed $record
     * @param  mixed $mode
     * @return array
     */
    protected function setRecord($record, $mode = 'insert') : array
    {
        if (!in_array($mode, ['insert', 'update', 'get']))
        {
            throw new RestApiException("Datamodel::setRecord - invalid mode:[{$mode}]", 500);
        }


        foreach ($this->fieldList as $fieldName => $field)
        {/* @var $field BaseFieldType */

            if ($field->isAssignable($mode) or true)
            {

                if ($field->isAuto($mode))
                {
                    $value = $field->getValue($record, $mode);
                    $record[$fieldName] = $value;
                } elseif (isset($record[$fieldName]))  // TODO only if plain insert-update !
                {
                    // if mode= update and not present then do not create record entry!
                    $value = $record[$fieldName] ?? null;
                    $value = $field->format($value);
                    $record[$fieldName] = $value;
                }
            } elseif (isset($record[$fieldName]))
            {
                // if field value added as a parameter, remove it - wont be used
                unset($record[$fieldName]);
            }
        }

        return $record;
    }

    /**
     * 
     * @param array $parameters
     * @param string $processname
     * @return array
     */
    protected function validate(array $parameters = [], string $processname = 'all')
    {
        $errorList = [];
        foreach ($this->fieldList as $fieldName => $field)
        {            
            /* @var $field BaseFieldType */
            
            if ($field->isInsertOnly() and $processname == 'update')                continue;
            
            if ($field->isAuto())                continue;
            
            if (isset($parameters[$fieldName]))
            {

                $value = $parameters[$fieldName];
                if (!$field->isRequiredFullfilled($value))
                {
                    $errorList[] = "{$fieldName} is required";
                }
                if (!$field->isValid($value))
                {
                    $errorList[] = "{$fieldName} is not a vali value/dataformat";
                }
            } else
            {
                $debug = 1;
            }
        }
        // TODO:
        // - add uniqueCheck - must be implemented json vs DB!
        // OK add typecheck  - isValid($value)
        // OK add required    - isReuired($value)

        return $errorList;
    }
    
    /**
     * getLastCounterValue
     *
     * @param  string $fieldName
     * @param  int $prefixLen
     * @param  int $counterLength
     * @param  array $record
     * @param  array $scopeFields
     * @return int
     */
    public function getLastCounterValue(string $fieldName, int $prefixLen, int $counterLength, array $record, array $scopeFields = []): int
    {
        return 0;
    }
    
    /**
     * isIdField
     *
     * @param  string $fieldName
     * @return bool
     */
    public function isIdField(string $fieldName) : bool  {

        return in_array($fieldName, $this->idFields) ;
    }


}
