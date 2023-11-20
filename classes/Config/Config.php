<?php

namespace Config;

use Util\JsonHandler;

class Config
{

    use JsonHandler;

    /**
     * 
     * @var array
     */
    private $config = null;

    /**
     * 
     * @var Config|null
     */
    private static $configInstance = null;

    /**
     * 
     */
    final private function __construct()
    {
        $defaultConfig  = $this->getJsonFromFile(CONFIGDIR . "/default.config.json") ?? [];
        $customConfig = $this->getJsonFromFile(CONFIGDIR . "/config.json", false);

        $config = array_replace_recursive($defaultConfig, $customConfig);

        $this->config = $config;
    }

    /**
     * 
     * @return Config
     */
    public static function getInstance()
    {
        if (self::$configInstance === null) {
            self::$configInstance = new \Config\Config();
        }
        return self::$configInstance;
    }

    /**
     * 
     * @param string $parameterName
     * @param bool $throwException
     * @param type $defaultValue
     * @return type
     * @throws Exception
     */
    public function getValue(string $parameterName, $defaultValue = 'throwExeptionIfNotFound', array $configBranch = null)
    {

        $config = $configBranch ?? $this->config;

        if ($dividerPos = strpos($parameterName, '/')) {
            $branchPath = substr($parameterName, 0, $dividerPos);            

            $config = $config[$branchPath];
            $parameterName        = substr($parameterName, $dividerPos + 1);

            return self::getValue($parameterName, $defaultValue, $config);
        }

        if ($defaultValue === 'throwExeptionIfNotFound' and !isset($config[$parameterName])) {
            throw new \Exception("Config parameter [{$parameterName}] should be set..");
        }

        $value = $config[$parameterName] ?? $defaultValue;


        // if ($defaultValue === 'throwExeptionIfNotFound' and!isset($this->config[$parameterName]))
        // {
        //     throw new \Exception("Config parameter [{$parameterName}] should be set..");
        // }

        // $value = $this->config[$parameterName] ?? $defaultValue;

        return $value;
    }
}
