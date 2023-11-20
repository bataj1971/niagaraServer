<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiDestinationService
 *
 * @author Bata Jozsef
 *
 */
class RestApiDestinationService extends DataModelRestService
{

    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Destination');
        parent::__construct($response, $model);
    }

}
