<?php

use Api\Service\DataModelRestService;
use DataModel\DbModel;
use Api\Service\RestResponse;
use DataModel\DataModel;
use DataModel\ModelFactory;
use Models\ReceiptDataModel;
/**
 * 
 */
class RestApiReceiptService extends DataModelRestService
{

    protected ReceiptDataModel $receiptDataModel ;    

    public function __construct(RestResponse $response)
    {        
        $this->receiptDataModel = ReceiptDataModel::getInstance();
        parent::__construct($response, $this->receiptDataModel);
    }

    public function get(array $parameters): void
    {
        //add receipt lines, customerdata to record
        parent::get($parameters);        
        $this->getLines($parameters);
    }

    public function addLine($parameters): void
    {
        $result = $this->receiptDataModel->addLine($parameters);
        $this->response->addArrayAsNodesToBody($result);
    }

    public function getLine($parameters): void
    {
        $result = $this->dataModel->getRecord($parameters);
        $this->response->addArrayAsNodesToBody($result);
    }

    public function getLines($parameters): void
    {
        // todo get line with articlename,         
        $result = $this->receiptDataModel->getLines($parameters);
        $this->response->addNodeToBody('lines',$result);
    }

    public function deleteLines($parameters): void
    {
        // $result = $this->receiptLineDataModel->deleteRecord($parameters);
        $result = $this->receiptDataModel->deleteLine($parameters);
        $this->response->addArrayAsNodesToBody($result);
    }

}
