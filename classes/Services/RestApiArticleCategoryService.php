<?php
use Api\Service\DataModelRestService;
use Api\Service\RestResponse;

/**
 * Description of RestApiArticleCategoryService
 *
 * @author Bata Jozsef
 */
class RestApiArticleCategoryService extends DataModelRestService
{

    public function __construct(RestResponse $response)
    {
        parent::__construct($response,new DataModel\DbModel('ArticleCategory'));
    }

}
