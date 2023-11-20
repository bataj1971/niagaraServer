<?php

namespace DataModel;

use DataModel\DataModel;
use DataModel\DbModel;

/**
 * ModelFactory
 */
class ModelFactory
{    
    /** @var mixed $instances */
    protected static $instances = [];
    
    /**
     * getModelInstance
     *
     * @param  string $modelName
     * @return DataModel
     */
    public static function getModelInstance(string $modelName) : DataModel
    {
        if (!isset(self::$instances[$modelName])) {

            $className = "{$modelName}Model";
            $classPath = CLASSES . "Models/{$className}.php";

            
            if (file_exists($classPath)) 
            {       
                // if there is a class defined with this model use it:         
                $classNameWithNameSpace = "Models\\{$modelName}Model";
                $modelInstance = new $classNameWithNameSpace();
            } else {
                // if no class defined, fall back to DbModel and let the json definition do the job:
                $modelInstance = new DbModel($modelName);
            }

            self::$instances[$modelName] = $modelInstance;
        }

        return self::$instances[$modelName];
    }
}
