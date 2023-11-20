<?php


namespace Controllers;

use Application\PageController;
use Config\DataBaseMaintenance;
use Config\EnvironmentSetup;
use Config\TestDataLoader;
use Util\DB;

/**
 * Description of AdminController
 *
 * @author Bata Jozsef 
 */
class AdminController extends PageController
{

    protected $message = '';
    protected $dbStatus = false;
    protected $dbStatusMessage = '';

    /**
     * 
     * @param array $paramList
     */
    public function render(array $paramList)
    {
        $todo = [
            'createdb' => ($_POST['createdb'] ?? 'off') === 'on',
            'cleardb' => ($_POST['cleardb'] ?? 'off') === 'on',
            'addtestdata' => ($_POST['addtestdata'] ?? 'off') === 'on',
            'adminpw' => ($_POST['adminpw'] ?? ''),
            'generatehtaccess' => ($_POST['generatehtaccess'] ?? 'off') === 'on',
            'generatecss' => ($_POST['generatecss'] ?? 'off') === 'on',
        ];

        try {
            $db = DB::getInstance();
            $this->dbStatus = true;
            $this->dbStatusMessage = "Database ready:" . $db->getDatabaseName();
        } catch (\Exception $e) {
            $this->dbStatus = false;
            $this->dbStatusMessage = "Database NOT ready:" . $e->getMessage();
        }

        $this->data['testDataLoaderReport'] = [];
        $this->data['dataBaseMaintenanceReport'] = [];        
        

        if ($this->dbStatus) {
            
            $dataBaseMaintenance = new DataBaseMaintenance(true);
            $testDataloader = new TestDataLoader();

            if ($todo['cleardb']) {
                $dataBaseMaintenance->dropAllTables();
            }

            if ($todo['cleardb'] and $todo['createdb']) {
                $dataBaseMaintenance->createTables();
                $testDataloader->createDefaultUsersAndGroups($todo['adminpw']);
            }

            if ($todo['cleardb'] and $todo['createdb'] and $todo['addtestdata']) {


                $testDataList = $this->getJsonFromFile("testData/testDataList.json");

                foreach ($testDataList as $modelName => $testDataFile) {
                    // $testDataloader->loadTestData($moduleName, 'data/' . $testDataFile);
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
            $this->data['testDataLoaderReport'] = $testDataloader->getReport();
            $this->data['dataBaseMaintenanceReport'] = $dataBaseMaintenance->getReport(); 


        }

        $environmentSetup = new EnvironmentSetup();
        $this->data['environmentSetupReport'] = [];

        if ($todo['generatecss']) {
            $environmentSetup->renderCss();            
        }

        if ($todo['generatehtaccess']) {
            $environmentSetup->setHtAccess();
        }

        $this->data['environmentSetupReport'] = $environmentSetup->getReport();


        $createStatement = file_get_contents(LOGDIR . "testCreateDatabase.sql") ?? "no query generated yet";

        $this->data['dbStatus'] = $this->dbStatus;
        $this->data['dbStatusMessage'] = $this->dbStatusMessage;
        $this->data['message'] = "...";
        $this->data['createStatement'] = $createStatement;
        echo $this->renderPage('admin');
    }
}
