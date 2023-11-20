<?php
namespace Api\Service;

use DataModel\DataModel;
use Api\Service\RestResponse;
use Exceptions\RestApiException;

/**
 * Description of JsonModelRestService
 *
 * @author Bata Jozsef 
 */
abstract class DataModelRestService extends RestService
{
    
    /** @var mixed $entityName */
    protected string $entityName;
    protected DataModel $dataModel;
    
    
    /**
     * __construct
     *
     * @param  mixed $response
     * @param  mixed $model
     * @return void
     */
    function __construct(RestResponse $response, DataModel $model)
    {
        parent::__construct($response);
        $this->entityName = $this->getEntityName();
        $this->dataModel = $model; 
    }
    
    /**
     * post
     *
     * @param  array $parameters
     * @return void
     */
    public function post(array $parameters): void
    {
        // inserting new record
        $idParams =  $this->dataModel->insertRecord($parameters);        
        
        // fill response with get method        
        $this->get($idParams);        
        
        // set httpcode to 201 (we dont touch response body at this point)
        $this->response->setHttpCode(201);
    }

    public function get(array $parameters): void
    {

        $result = $this->dataModel->getRecord($parameters);
        $this->response->addArrayAsNodesToBody($result );
    }

    public function put(array $parameters): void
    {
        $updatedRecords = $this->dataModel->updateRecord($parameters);    
        if ($updatedRecords == 0) {
               throw new RestApiException("Record not found", 404);
        }
        $result = $this->get($parameters);
        
        // $this->response->addArrayAsNodesToBody($result );
    }
    
    /**
     * index
     *
     * @param  array $parameters
     * @return void
     */
    public function index(array $parameters): void
    {

        $result = $this->dataModel->getList($parameters);
        $this->response->addArrayAsNodesToBody($result );
    }
    
    /**
     * delete
     *
     * @param  array $parameters
     * @return void
     */
    public function delete(array $parameters): void
    {

        $result =  $this->dataModel->deleteRecord($parameters);
        $this->response->addArrayAsNodesToBody($result );

    }

    /**
     * @return false|string
     */
    protected function getEntityName()
    {
        $className = get_class($this);
        $entityName = substr($className, 7, -7);
        return $entityName;
    }
    
    /**
     * initService
     *
     * @return void
     */
    protected function initService()
    {
        
    }

}
