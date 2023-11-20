<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiRightService
 * 
 * @author Bata Jozsef 
 * 
 */
class RestApiRightService extends DataModelRestService
{
    
    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {        
        $model = ModelFactory::getModelInstance('Right');
        parent::__construct($response, $model); 
    }

}
