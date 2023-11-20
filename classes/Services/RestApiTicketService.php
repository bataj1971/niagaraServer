<?php

use Api\Service\DataModelRestService;
use Api\Service\RestResponse;
use DataModel\ModelFactory;

/**
 * RestApiTicketService
 *
 * @author Bata Jozsef
 *
 */
class RestApiTicketService extends DataModelRestService
{

    /**
     * __construct
     *
     * @param  mixed $response
     * @return void
     */
    public function __construct(RestResponse $response)
    {
        $model = ModelFactory::getModelInstance('Ticket');
        parent::__construct($response, $model);
    }

}
