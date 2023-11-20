<?php
use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * Description of RestApiCustomerCategoryService
 *
 * @author Bata Jozsef 
 */
class RestApiCustomerCategoryService  extends DataModelRestService
{
    
    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        
        $model = ModelFactory::getModelInstance('CustomerCategory');
        parent::__construct($response, $model);
    }

}
