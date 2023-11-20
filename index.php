<?php

    require("config/sysConfig.php");
    require("classes/Config/AutoLoad.php");    
    
    
    ini_set("log_errors", 0);
    ini_set("error_log", LOGDIR .date("Ymd")."_php_error.log");



    include "vendor/autoload.php";

    use Application\Application;
    $application = new Application();
    $application->run();
    