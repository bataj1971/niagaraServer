<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiAircraftService
 *
 * @author Bata Jozsef
 *
 */
class RestApiAircraftService extends DataModelRestService
{

    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Aircraft');
        parent::__construct($response, $model);
    }

}
