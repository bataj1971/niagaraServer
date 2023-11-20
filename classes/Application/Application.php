<?php

namespace Application;
use \Controllers;
use Api\Server\ApiServer;

/**
 * Application
 */
class Application
{
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
    }
    
    /**
     * main entrypoint of the clas
     *
     * @return void
     */
    public function run() {
        
        $restParam1 = filter_input(INPUT_GET,'restparam1') ?? '';
        $restParam2 = filter_input(INPUT_GET,'restparam2') ?? '';
        $restParam3 = filter_input(INPUT_GET,'restparam3') ?? '';
        
        
        switch ($restParam1)
        {
            case 'api'    :
                 $testAPIServer = new ApiServer();
                 $testAPIServer->run();
                 break;
            case '':

                new Controllers\TestController([]);
                break;
            case 'admin':
                new Controllers\AdminController([]);
                break;

        }
    }

}
