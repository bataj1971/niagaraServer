<?php

use Api\Service\DataModelRestService;
use Models\UserModel;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiUserService
 * 
 * @author Bata Jozsef 
 * 
 */
class RestApiUserService extends DataModelRestService
{
    
    
    protected UserModel $userModel;
        
    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('User');
        parent::__construct($response, $model);         
    }
    
    /**
     * getUserGroups
     *
     * @param  array $parameters
     * @return void
     */
    public function getUserGroups(array $parameters){
        $groups = $this->dataModel->getUserGroups($parameters);        
        $this->response->addArrayAsNodesToBody($groups);
    }
    
    /**
     * getUserRights
     *
     * @param  array $parameters
     * @return void
     */
    public function getUserRights(array $parameters){
        $rights = $this->dataModel->getUserRights($parameters);
        $this->response->addArrayAsNodesToBody( $rights);
    }

}
