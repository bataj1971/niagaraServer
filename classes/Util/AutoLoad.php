<?php
spl_autoload_register(function ($className) {

    

    $classPath = str_replace("\\", '/', $className);
    $classPath = "classes/".str_replace("\\", '/', $className).'.php';
       
    if (file_exists($classPath))
    {
       include $classPath;    
    } 
    else 
    {
        error_log("autoload class not found :[$className]" );        
    }    
    
});
