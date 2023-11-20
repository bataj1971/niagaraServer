<?php
use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * Description of RestApiCurrencyService
 *
 * @author Bata Jozsef 
 */
class RestApiCurrencyService extends DataModelRestService
{
    
    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Currency');
        parent::__construct($response, $model);
    }

}
