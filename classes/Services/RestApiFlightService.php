<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiFlightService
 *
 * @author Bata Jozsef
 *
 */
class RestApiFlightService extends DataModelRestService
{

    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Flight');
        parent::__construct($response, $model);
    }

}
