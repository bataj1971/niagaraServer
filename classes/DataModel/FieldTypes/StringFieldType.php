<?php

namespace DataModel\FieldTypes;

/**
 * Description of StringFieldType
 *
 * @author Bata Jozsef 
 */
class StringFieldType extends \DataModel\BaseFieldType
{
    public function isEmpty($value = null): bool
    {
        if ($value === '') return true;
        if ($value === null) return true;
        
        return false;
    }    
}
