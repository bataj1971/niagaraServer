<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiPilotService
 *
 * @author Bata Jozsef
 *
 */
class RestApiPilotService extends DataModelRestService
{

    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Pilot');
        parent::__construct($response, $model);
    }

}
