<?php

namespace DataModel\FieldTypes;

/**
 * Description of PasswordFieldType
 *
 * @author Bata Jozsef 
 */
class PasswordFieldType extends \DataModel\BaseFieldType
{
        
    /**
     * prepareValueForQuery
     *
     * @param  mixed $value
     * @return mixed
     */
    public function prepareValueForQuery(mixed $value): mixed
    {
        $passwordHash = password_hash($value, PASSWORD_BCRYPT );
        return $passwordHash;
    }

    
}
