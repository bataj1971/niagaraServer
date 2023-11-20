<?php

namespace DataModel\FieldTypes;

/**
 * Description of CratedAtFieldtype
 *
 * @author Bata Jozsef 
 */
class CreatedAtFieldType extends DateTimeFieldType
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
        // use this if value should be set with PHP
        // $this->assignEvent = 'auto-insert';        
        
        // use this if value is set  by db automaticaly
        $this->assignEvent = 'none-db';        
    }
        
        
    /**
     * getValue
     *
     * @param  array $record
     * @param  string $mode
     * @return string
     */
    public function getValue(array $record, string $mode) :string
    {
        return  $this->getCurrentTimeStamp();
    }
    
}
