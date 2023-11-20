<?php
use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * Description of RestApiCountryService
 *
 * @author Bata Jozsef 
 */
class RestApiCountryService extends DataModelRestService
{
    
    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)    
    {
        $model = ModelFactory::getModelInstance('Country');
        parent::__construct($response, $model);
    }

}
