<?php

namespace Config;

use Util\ScssCompiler;
use Util\JsonHandler;
use Config\TestDataLoader;
use Util\DB;
use Util\ReportHandler;

/**
 * Setting up environment dependent files 
 *
 * @author Bata Jozsef 
 */
class EnvironmentSetup
{


    use ReportHandler;
    use JsonHandler;

    /**
     * 
     * @var Config
     */
    protected Config $config;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = \Config\Config::getInstance();
        // $this->setup();
    }

    /**
     * setup
     *
     * @return void
     */
    protected function setup()
    {
        $this->setHtAccess();
        $this->renderCss();


        $dataBaseMaintenance = new DataBaseMaintenance(true);

        $dataBaseMaintenance->dropAllTables();
        $dataBaseMaintenance->createTables();
        $dataBaseMaintenance->writeLog();
        echo $dataBaseMaintenance->getLogs(true);

        $testDataloader = new TestDataLoader();
        $testDataloader->createDefaultUsersAndGroups();

        $testDataList = $this->getJsonFromFile("testData/testDataList.json");

        foreach ($testDataList as $modelName => $testDataFile) {
            $fileType = pathinfo($testDataFile, PATHINFO_EXTENSION);
            switch ($fileType) {
                case 'json':
                    $testDataloader->loadTestDataFromJson($modelName, 'testData/' . $testDataFile);
                    break;
                case 'sql':
                    $testDataloader->loadTestDataFromSqlQuery($modelName,'testData/' . $testDataFile);
                    break;
                case 'csv':
                    // TODO
            }
        }
    }


    /**
     * renderCss
     *
     * @return void
     */
    public function renderCss()
    {
        $this->addReport("scss compiling not used here");
        // try {
        //     $scssCompiler = new ScssCompiler();
        //     $scssCompiler->createCss();
        //     $this->addReport("css created from scss definitions");
        // } catch (\Exception $e) {
        //     $this->addReport("css generating failed:" . $e->getMessage(), "error");
        // }
    }


    /**
     * setHtAccess
     *
     * @return void
     */
    public function setHtAccess()
    {
        try {


            $changeList = [
                "baseurl" => $this->config->getValue('baseurl') ?? ''
            ];
            $htaccessRendered = file_get_contents("config/.htaccess.template");

            if ($htaccessRendered === false) {
                throw new \Exception("config/.htaccess.template missing or not readable");
            }

            foreach ($changeList as $key => $value) {
                $htaccessRendered  = str_replace("%%$key%%", $value, $htaccessRendered);
            }

            $success = file_put_contents('.htaccess', $htaccessRendered);

            if ($success === false) {
                throw new \Exception(".htaccess  file is not writable");
            }

            $this->addReport(".htaccess file created");
        } catch (\Exception $e) {
            $this->addReport("setHtAccess failed:" . $e->getMessage(), "error");
        }
    }
}
