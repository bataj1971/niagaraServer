<?php


use Api\Service\DataModelRestService;
use Models\CustomerModel;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * Description of RestApiCustomerService
 *
 * @author Bata Jozsef 
 */
class RestApiCustomerService extends DataModelRestService
{
    
    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Customer');
        parent::__construct($response, $model); 
    }

}
