<?php
use Api\Service\DataModelRestService;
use Api\Service\RestResponse;

/**
 * Description of RestApiArticleService
 *
 * @author Bata Jozsef 
 */
class RestApiArticleService extends DataModelRestService
{

    public function __construct(RestResponse $response)
    {
        parent::__construct($response, new DataModel\DbModel('Article'));
    }

}
