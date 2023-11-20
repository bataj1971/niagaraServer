<?php

namespace DataModel\FieldTypes;

/**
 * Description of ForeignIntegerIdFieldType
 *
 * @author Bata Jozsef 
 */
class ForeignIntegerIdFieldType extends \DataModel\BaseFieldType
{

    /** @var string $fNameExpression */
    protected string $fNameExpression = '';
        
    /** @var string $fTableName */
    protected string $fTableName = '';

    /** @var string $fTableIdField */
    protected string $fTableIdField = '';
    
    /**
     * __construct
     *
     * @param  array $fieldProps
     * @return void
     */
    public function __construct(array $fieldProps = [])
    {
        parent::__construct($fieldProps);
        
        $this->fNameExpression = $this->getProperty('fname', $fieldProps);
        $this->fTableName = $this->getProperty('ftable', $fieldProps);
        $this->fTableIdField = $fieldProps['ftableid'] ?? 'id';
    }
}
