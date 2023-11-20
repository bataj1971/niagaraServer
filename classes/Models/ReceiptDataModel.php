<?php

namespace Models;

use DataModel\DbModel;
use DataModel\ModelFactory;
use Exceptions\RestApiException;

/**
 * Description of ReceiptDataModel
 *
 * @author Bata Jozsef 
 */
class ReceiptDataModel extends DbModel
{
    protected DbModel $recieptLineModel;
    protected DbModel $articleModel;
    protected DbModel $customerModel;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Receipt');
        $this->recieptLineModel = ModelFactory::getModelInstance('ReceiptLine');
        $this->customerModel = ModelFactory::getModelInstance('Customer');
        $this->articleModel = ModelFactory::getModelInstance('Article');
    }


    /**
     * addLine
     *
     * @param  mixed $parameters
     * @return array
     */
    public function addLine($parameters): array
    {
        $receiptId = $parameters['receipt_id'];
        $receipt = $this->getRecord(['id' => $receiptId]);

        $customerId = $receipt['customer_id'];
        $customer = $this->customerModel->getRecord(['id' => $customerId]);

        $articleId = $parameters['article_id'];
        $article = $this->articleModel->getRecord(['id' => $articleId]);

        $record = $this->recieptLineModel->insertRecord($parameters);
        $record = $this->recieptLineModel->getRecord($record);
        return $record;
    }

    /**
     * getLine
     *
     * @param  mixed $parameters
     * @return array
     */
    public function getLine($parameters): array
    {
        throw new RestApiException("Not implemented - todo", 404);
        return $parameters;
    }



    public function getRecord(array $parameters = []): array
    {
        $response = parent::getRecord($parameters);
        return $response;
    }

    /**
     * getLines
     *
     * @param  mixed $parameters
     * @return array
     */
    public function getLines($parameters): array
    {
        // throw new RestApiException("Not implemented - todo",404);
        $receiptParams = ['receipt_id' => $parameters['id']];
        $lines = $this->recieptLineModel->getList($receiptParams);
        return $lines;
    }

    /**
     * deleteLine
     *
     * @param  mixed $parameters
     * @return array
     */
    public function deleteLine($parameters): array
    {
        throw new RestApiException("Not implemented - todo", 404);
        return $parameters;
    }

    /**
     * modifyLine
     *
     * @param  mixed $parameters
     * @return array
     */
    public function modifyLine($parameters): array
    {
        throw new RestApiException("Not implemented - todo", 404);
        return $parameters;
    }

    protected function getQueryFieldList(): array
    {
        $fieldList = parent::getQueryFieldList();

        $fieldList['customer'] = "
            JSON_OBJECT(				
                    'name',customers.name,
                    'address',JSON_OBJECT(
                                'id',address.id,
                                'name',address.name,
                                'city',address.city,
                                'street',address.street,
                                'zipcode',address.zipcode,
                                'state',address.state,
                                'description',address.description
                    ),
                    'shipping_address',JSON_OBJECT(
                                'id',shipping_address.id,
                                'name',shipping_address.name,
                                'city',shipping_address.city,
                                'street',shipping_address.street,
                                'zipcode',shipping_address.zipcode,
                                'state',shipping_address.state,
                                'description',shipping_address.description
                                )            
				)            
        ";



        // $fieldList['address'] = "
        //     JSON_OBJECT(
		// 		'id',address.id,
		// 		'name',address.name,
		// 		'city',address.city,
		// 		'street',address.street,
		// 		'zipcode',address.zipcode,
		// 		'state',address.state,
		// 		'description',address.description
		// 		)            
        // ";

        // $fieldList['shipping_address'] = "
        //     JSON_OBJECT(
		// 		'id',shipping_address.id,
		// 		'name',shipping_address.name,
		// 		'city',shipping_address.city,
		// 		'street',shipping_address.street,
		// 		'zipcode',shipping_address.zipcode,
		// 		'state',shipping_address.state,
		// 		'description',shipping_address.description
		// 		)            
        // ";

        return $fieldList;
    }

    /**
     * getQueryJoin
     *
     * @return array
     */
    protected function getQueryJoin(): array

    {
        $joinList = parent::getQueryJoin();
        $joinList['customer'] = "LEFT JOIN customers ON customers.id = receipts.customer_id";
        $joinList['address'] = "LEFT JOIN addresses as address   ON address.id = customers.address_id";
        $joinList['shipping_address'] = "LEFT JOIN addresses as shipping_address  ON shipping_address.id = customers.shipping_address_id";
        return $joinList;
    }
}
