<?php

namespace DataModel\FieldTypes;

/**
 * Description of CreatedByFieldtype
 *
 * @author Bata Jozsef 
 */
class CreatedByFieldType extends \DataModel\BaseFieldType
{
    
    /**
     * __construct
     *
     * @param  array $fieldProps
     * @return void
     */
    public function __construct(array $fieldProps = [])
    {
        parent::__construct($fieldProps);
        $this->assignEvent = 'auto-insert';        
    }    
    
    /**
     * getValue
     *
     * @param  array $record
     * @param  string $mode
     * @return string
     */
    public function getValue(array $record, string $mode):string
    {
        return  $this->getCurrentUserId();
    }

}
