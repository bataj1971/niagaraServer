<?php
spl_autoload_register(function ($className) {

    $classPath = CLASSES.str_replace("\\", '/', $className).'.php';

    if (file_exists($classPath))
    {
       include $classPath;
    }
    else
    {
        error_log("autoload class not found :[$className] - path:[$classPath]");
    }

});