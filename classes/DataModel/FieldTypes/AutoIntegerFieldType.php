<?php

namespace DataModel\FieldTypes;

/**
 * Description of AutoIntegerFieldType
 *
 * @author Bata Jozsef 
 */
class AutoIntegerFieldType extends \DataModel\BaseFieldType
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
        $this->assignEvent = 'none-db';            
    }

}
