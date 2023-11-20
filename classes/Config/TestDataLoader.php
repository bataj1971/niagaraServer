<?php

namespace Config;

use DataModel\ModelFactory;
use Config\DataBaseMaintenance;
use DataModel\ModelFactory as DataModelModelFactory;
use Util\DB;
use Util\JsonHandler;
use Util\Logger;
use Util\ReportHandler;

/**
 * TestDataLoader
 * 
 * @author Bata Jozsef
 * 
 */
class TestDataLoader
{
    use JsonHandler;
    use ReportHandler;

    /**
     * @var DB
     */
    protected $db;

    /**
     * @var Logger
     */
    protected $logger;


    /**
     * @var DataBaseMaintenance
     */
    protected $dataBaseMaintenance;

    /**
     * @var array
     */
    protected $modelList = [];


    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // $this->db = DB::getInstance(false);  // no transactions here        
        $this->dataBaseMaintenance = new DataBaseMaintenance(false);
        $this->modelList = $this->dataBaseMaintenance->getModelList();
        $this->logger = Logger::getInstance('TestDataloader');
    }


    /**
     * createDefaultUsersAndGroups
     *
     * @return void
     */
    public function createDefaultUsersAndGroups(string $adminPassword = 'admin')
    {

        try {


            $userModel = ModelFactory::getModelInstance("User");

            // this should be defined by incoming parameter..
            $adminUser = [
                'name' => 'admin',
                'loginname' => 'admin',
                'password' => $adminPassword,
                'email' => 'admin@test.com'
            ];
            $userModel->insertRecord($adminUser);
            DB::getInstance()->commitTransaction();
            $this->addReport("Default users and groups added");

        } catch (\Exception $e) {

            $this->addReport("Error adding default users and groups: " . $e->getMessage(), 'error');
        }
    }

    /**
     * loadTestData
     *
     * @param  mixed $modelName
     * @param  mixed $fileName
     * @return void
     */
    public function loadTestDataFromJson($modelName, $fileName)
    {
        $c = 0;
        try {
            
            $model = ModelFactory::getModelInstance($modelName);

            $data = $this->getJsonFromFile($fileName);

            foreach ($data as $record) {
                $model->insertRecord($record);
                $c++;
            }
            DB::getInstance()->commitTransaction();

            $this->addReport("{$c} records added to {$modelName}  from {$fileName}");

        } catch (\Exception $e) {

            $this->addReport("Error adding testdata to {$modelName} at {$c} record,  from {$fileName}:  " . $e->getMessage(),'error');
        }
    }

    public function loadTestDataFromSqlQuery($modelName,$fileName) {
        try {
            $sqlQuery = file_get_contents($fileName);
            $result = DB::getInstance()->runQuery($sqlQuery,[]);
            $c = $result['affectedRows'];

            $this->addReport("{$c} records added to {$modelName}  from {$fileName}");
        } catch (\Exception $e) {

            $this->addReport("Error adding testdata from  {$fileName}:  " . $e->getMessage(), 'error');
        }

    }

}
