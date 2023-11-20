<?php

namespace DataModel\FieldTypes;

use DataModel\BaseFieldType;
use Exceptions\RestApiException;

/**
 * Description of JsonFieldType
 *
 * @author Bata Jozsef 
 */
class JsonFieldType extends BaseFieldType
{
    public function prepareValueForQuery(mixed $value): mixed
    {
        $jsonValue = json_encode($value ?: []);

        if ($lastJsonError = json_last_error()) {
            throw new RestApiException("Field:[{$this->name}] must be a proper json or must be empty. Json error:{$lastJsonError}," . json_last_error_msg());
        }

        return $jsonValue;
    }

    public function isValid($value): bool
    {
        $jsonValue = json_encode($value ?: []);

        if ($lastJsonError = json_last_error()) {
            throw new RestApiException("Field:[{$this->name}] must be a proper json or must be empty. Json error:{$lastJsonError}," . json_last_error_msg());
        }
        return true;
    }


}
