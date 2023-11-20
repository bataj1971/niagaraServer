<?php

use Api\Service\DataModelRestService;
use DataModel\DbModel;
use Api\Service\RestResponse;
/**
 *
 */
class RestApiReceiptLineService extends DataModelRestService
{

    public function __construct(RestResponse $response)
    {
        parent::__construct($response, new DbModel('ReceiptLine'));
    }

}
