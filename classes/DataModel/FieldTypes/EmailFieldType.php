<?php

namespace DataModel\FieldTypes;

/**
 * Description of EmailFieldType
 *
 * @author Bata Jozsef 
 */
class EmailFieldType extends \DataModel\FieldTypes\StringFieldType
{
    /**
     * 
     * @param type $value
     * @return bool
     */
    public function isValid($value): bool    
    {           
        // note empty value is handled by required attribute
        if ($this->isEmpty($value)) return true;
        
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true ;
        }
        
        return false;
    }
}
