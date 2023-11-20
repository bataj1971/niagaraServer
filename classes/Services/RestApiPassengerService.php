<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiPassengerService
 *
 * @author Bata Jozsef
 *
 */
class RestApiPassengerService extends DataModelRestService
{

    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Passenger');
        parent::__construct($response, $model);
    }

}
