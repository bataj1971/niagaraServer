<?php

namespace DataModel;

use Exceptions\RestApiException;

/**
 * Description of BaseFieldType
 *
 * @author Bata Jozsef 
 */
abstract class BaseFieldType
{

    /** @var string $name */
    protected string $name;

    /** @var string $dbName */
    protected string $dbName;

    /** @var bool $required */
    protected bool $required = false;

    /** @var string $type */
    protected string $type = '';

    /** @var array $applyForProcess */
    protected array $applyForProcess = [];

    /** @var mixed $defaultValue */
    protected ?string $defaultValue = null;

    /** @var mixed $idField */
    protected bool $idField = false;

    // protected bool $autoIfInsert = false;
    // protected bool $autoIfUpdate = false;
    // protected bool $insertOnly = false;

    /** @var mixed $assignEventmatrix */
    protected array $assignEventmatrix = [
        "none-db" => ['insert' => false, 'update' => false, 'auto' => false],
        "auto-insert" => ['insert' => true, 'update' => false, 'auto' => true],
        "auto-update" => ['insert' => false, 'update' => true, 'auto' => true],
        "auto-insert-update" => ['insert' => true, 'update' => true, 'auto' => true],
        "insert-only" => ['insert' => true, 'update' => true, 'auto' => false],
        "insert-update" => ['insert' => true, 'update' => true, 'auto' => false],
    ];

    /** @var mixed $assignEvent */
    protected string $assignEvent = 'insert-update';

    /** @var mixed $fieldTypeList */
    private static array $fieldTypeList = [
        "string" => "StringFieldType",
        "text" => "TextFieldType",
        "date" => "DateFieldType",
        "datetime" => "DatetimeFieldType",
        "integer" => "IntegerFieldType",
        "bool" => "BoolFieldType",
        "fid" => "ForeignIntegerIdFieldType",
        "float" => "FloatFieldType",
        "decimal" => "DecimalFieldType",
        "autointeger" => "AutoIntegerFieldType",
        "json" => "JsonFieldType",
        "guid" => "GuidFieldType",
        "email" => "EmailFieldType",
        "point" => "PointFieldType",
        "password" => "PasswordFieldType",
        "autointeger" => "AutoIntegerFieldType",
        "autocounter" => "AutoCounterFieldType",
        "createdby" => "CreatedByFieldType",
        "createdat" => "CreatedAtFieldType",
        "modifiedby" => "ModifiedByFieldType",
        "modifiedat" => "ModifiedAtFieldType",

    ];

    /** @var mixed $dataModel */
    protected DataModel $dataModel;

    /**
     * getFieldTypeInstance
     *
     * @param  array $fieldProps
     * @param  mixed $dataModel
     * @return BaseFieldtype
     */
    public static function getFieldTypeInstance(array $fieldProps, DataModel $dataModel): BaseFieldtype
    {
        $type = $fieldProps['type'] ?? 'string';
        if (!isset(self::$fieldTypeList[$type])) {
            throw new RestApiException("Unknown fieldType: $type ");
        }
        $fieldTypeClassName = 'DataModel\\FieldTypes\\' . self::$fieldTypeList[$type];

        $fieldName = $fieldProps['name'] ?? '?';
        $idField = $dataModel->isIdField($fieldName);

        $fieldTypeInstance = new $fieldTypeClassName($fieldProps, $idField);
        $fieldTypeInstance->setDataModel($dataModel);

        return $fieldTypeInstance;
    }

    /**
     * __construct
     *
     * @param  array $fieldProps
     * @param  bool $idField
     * @return void
     */
    public function __construct(array $fieldProps = [], bool $idField = false)
    {
        $this->type = $fieldProps['type'] ?? 'string';
        $this->required = $fieldProps['required'] ?? false;
        $this->applyForProcess = $fieldProps['applyforprocess'] ?? [];
        $this->name = $fieldProps['name'];
        $this->dbName = $fieldProps['dbname'] ?? $fieldProps['name'];
        $this->idField = $idField;
    }

    /**
     * setDataModel
     *
     * @param  mixed $dataModel
     * @return void
     */
    protected function setDataModel(DataModel $dataModel)
    {
        $this->dataModel = $dataModel;
    }

    /**
     * isValid
     *
     * @param  mixed $value
     * @return bool
     */
    public function isValid($value): bool
    {
        return true;
    }

    /**
     * isRequired
     *
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * 
     * @param type $value
     * @param type $processType  : insert,update,delete, get
     * @return bool
     */
    public function isRequiredFullfilled($value = '', $processType = 'insert'): bool
    {
        if (!$this->required) {
            return true;
        }

        if ($this->isEmpty($value)) {
            return false;
        }
        return true;
    }

    /**
     * isEquel
     *
     * @param  mixed $value1
     * @param  mixed $value2
     * @return bool
     */
    public function isEquel($value1, $value2): bool
    {
        return ($value1 === $value2);
    }

    /**
     * isEmpty
     *
     * @param  mixed $value
     * @return bool
     */
    public function isEmpty($value): bool
    {
        return empty($value);
    }

    /**
     * format
     *
     * @param  mixed $value
     * @return mixed
     */
    public function format($value): mixed
    {
        $formattedValue = $value;
        return $formattedValue;
    }

    /**
     * isAssignable
     *
     * @param  string $mode
     * @return bool
     */
    public function isAssignable(string $mode = 'update'): bool
    {
        return $this->assignEventmatrix[$this->assignEvent][$mode] ?? false;
    }

    /**
     * isAuto
     *
     * @return bool
     */
    public function isAuto(): bool
    {
        return $this->assignEventmatrix[$this->assignEvent]['auto'] ?? false;
    }

    /**
     * getDefaultValue
     *
     * @return mixed
     */
    public function getDefaultValue(): mixed
    {
        return $this->defaultValue;
    }

    /**
     * getProperty
     *
     * @param  string $propertyName
     * @param  array $fieldProps
     * @param  bool $throwException
     * @return mixed
     */
    protected function getProperty(string $propertyName, array $fieldProps = [], bool $throwException = true): mixed
    {
        if (empty($fieldProps[$propertyName])) {
            throw new RestApiException("Field-definition: {$propertyName} should be defined");
        }
        $value = $fieldProps[$propertyName];
        return $value;
    }

    /**
     * getValue
     *
     * @param  array $record
     * @param  string $mode
     * @return string
     */
    public function getValue(array $record, string $mode): string
    {
        return $record[$this->name] ?? '';
    }

    /**
     * isInsertOnly
     *
     * @return bool
     */
    public function isInsertOnly(): bool
    {
        $insert = $this->assignEventmatrix[$this->assignEvent]['insert'] ?? false;
        $update = $this->assignEventmatrix[$this->assignEvent]['update'] ?? false;


        if ($insert and !$update) {
            return true;
        }

        return false;
    }

    /**
     * processInsert
     *
     * @return bool
     */
    public function processInsert(): bool
    {
        return $this->assignEventmatrix[$this->assignEvent]['insert'] ?? false;
    }

    /**
     * processUpdate
     *
     * @return bool
     */
    public function processUpdate(): bool
    {
        return $this->assignEventmatrix[$this->assignEvent]['update'] ?? false;
    }

    /**
     * assign
     *
     * @param  string $mode
     * @return string
     * TODO: what is this for..?
     */
    public function assign(string $mode): string
    {

        $assign = '';
        return $assign;
    }

    /**
     * getCurrentUserId
     *
     * @return int
     */
    protected function getCurrentUserId(): int
    {
        // TODO 
        // use Auth class here
        return 1;
    }

    /**
     * getCurrentTimeStamp
     *
     * @return string 
     */
    protected function getCurrentTimeStamp(): string
    {
        return gmdate('Y-m-d H:i:s');
    }

    /**
     * isIdField
     *
     * @return bool
     */
    public function isIdField(): bool
    {
        return $this->idField;
    }


    /**
     * prepareValueForQuery
     * override this if some special conversation neede for using in sql query
     *
     * @param  mixed $value
     * @return mixed
     */
    public function prepareValueForQuery(mixed $value): mixed
    {
        return $value;
    }

    /**
     * getType
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
