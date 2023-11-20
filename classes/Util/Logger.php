<?php

namespace Util;

use Config\Config;

/**
 * Logger
 * 
 * @author Bata Jozsef 
 * 
 * TODO:  implement:
 *              loglevels/methods: 
 *                   0 error
 *                   1 warning
 *                   2 log
 *                   3 debug
 * 
 */
class Logger
{
    const ERROR = 0;
    const WARNING = 1;
    const LOG = 2;
    const DEBUG = 3;


    /**
     * @var Logger
     */
    protected static $instances = [];



    /** @var string $logFile */
    protected string $logFile;

    /**
     * datePrefix
     *
     * @var bool
     */
    protected bool $datePrefix = true;

    /**
     * logLevel
     *
     * @var int
     */
    protected int $logLevel = 0;

    /**
     * __construct
     *
     * @param  string $name
     * @param  array $settings
     * @return void
     */
    protected function __construct(string $name, array $settings = [])
    {

        $this->logFile = "log/{$name}_" . date("Ymd") . ".log";

        $config = Config::getInstance();
        $logLevel = $config->getValue("loglevels/default","2");
        $logLevel = $config->getValue("loglevels/{$name}", $logLevel);

        $this->logLevel = $logLevel;
    }
    
    /**
     * getInstance
     *
     * @param  string $name
     * @param  array $settings
     * @return Logger
     */
    public static function getInstance(string $name = 'default', array $settings = []) :Logger
    {
        if (!isset(self::$instances[$name])) {
            self::$instances[$name] = new Logger($name, $settings);
        }
        return self::$instances[$name];
    }
        
    /**
     * log
     *
     * @param  mixed $message
     * @return void
     */
    public function debug($message)
    {
        if ($this->logLevel<self::DEBUG) return;
        $this->writeMessage('DEBUG', $message);
    }

    public function warning($message)
    {
        if ($this->logLevel < self::WARNING) return;
        $this->writeMessage('WARNING', $message);
    }

    public function log($message)
    {
        if ($this->logLevel < self::LOG) return;
        $this->writeMessage('LOG', $message);
    }

    public function error(string $message) {
        $this->writeMessage('ERROR', $message);
    }
    
    /**
     * writeMessage
     *
     * @param  mixed $level
     * @param  mixed $message
     * @param  mixed $newLine
     * @return void
     */
    protected function writeMessage($level, $message, $newLine = true)
    {
        $messageContent = ($newLine ? "\n" : "");
        $messageContent .= date('Y-m-d H:i:s');
        $messageContent .= " [".str_pad($level, 10)."] ";
        $messageContent .= $message;

        error_log($messageContent, 3, $this->logFile);
    }
}
