<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;


/**
 * Description of RestApiGroupService
 *
 * @author Bata Jozsef 
 */
class RestApiGroupService extends DataModelRestService
{

        
    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        
        $model = ModelFactory::getModelInstance('Group');
        parent::__construct($response, $model); 
    }

}
