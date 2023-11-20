<?php

namespace Application;

use Config\EnvironmentSetup;
use Conig\Config;
/**
 * All controllers should be extended from this class
 *
 * @author Bata Jozsef 
 */
abstract class BaseController
{
    use \Util\JsonHandler;
    
    /**
     * 
     * @var Config
     */
    protected $config;

    final public function __construct(array $paramList = []) 
    {
        $this->config = \Config\Config::getInstance();   

        
        $this->render($paramList);
    }

    abstract public function render(array $paramList) ;
    

    //put your code here
}
