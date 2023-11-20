<?php

namespace Models;

use DataModel\DbModel;
use Models\AddressHandler;


/**
 * Description of CustomerModel
 *
 * @author Bata Jozsef 
 */
class CustomerModel extends DbModel
{
    use AddressHandler;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Customer');
        $this->initAddressHandler();
    }
    
    /**
     * processDeleteRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function processDeleteRecord(array $parameters = []): array
    {
        $parameters = $this->deleteAddress($parameters, 'address', 'address_id');
        $parameters = $this->deleteAddress($parameters, 'shipping_address', 'shipping_address_id');

        return parent::processDeleteRecord($parameters);
    }
    
    /**
     * processGetRecord
     *
     * @param  array $parameters
     * @return array
     */
    protected function processGetRecord(array $parameters = []): array
    {
        $record = parent::processGetRecord($parameters);
        // $record = $this->getAddress($record, 'address', 'address_id');
        // $record = $this->getAddress($record, 'shipping_address', 'shipping_address_id');

        return $record;
    }
    
    /**
     * processInsertRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function processInsertRecord(array $parameters = []): array
    {

        $parameters = $this->insertAddress($parameters, 'address', 'address_id');
        $parameters = $this->insertAddress($parameters, 'shipping_address', 'shipping_address_id');
        return parent::processInsertRecord($parameters);
    }
    
    /**
     * processUpdateRecord
     *
     * @param  array $parameters
     * @return array
     */
    public function processUpdateRecord(array $parameters = []): array
    {
        $parameters = $this->updateAddress($parameters, 'address', 'address_id');
        $parameters = $this->updateAddress($parameters, 'shipping_address', 'shipping_address_id');

        return parent::processUpdateRecord($parameters);
    }

    /**
     * getQueryFieldList
     *
     * @return void
     */
    protected function getQueryFieldList(): array
    {
        $fieldList = parent::getQueryFieldList();



        $fieldList['address'] = "
            JSON_OBJECT(
                'id',addresses.id,
				'name',addresses.name,
				'city',addresses.city,
				'street',addresses.street,
				'zipcode',addresses.zipcode,
				'state',addresses.state,
				'description',addresses.description
				)            
        ";
        $fieldList['shipping_address'] = "
            JSON_OBJECT(
				'id',shipping_addresses.id,
				'name',shipping_addresses.name,
				'city',shipping_addresses.city,
				'street',shipping_addresses.street,
				'zipcode',shipping_addresses.zipcode,
				'state',shipping_addresses.state,
				'description',shipping_addresses.description
				)            
        ";

        return $fieldList;
    }

    
    /**
     * getQueryJoin
     *
     * @return array
     */
    protected function getQueryJoin():array
    {
        $joinList = parent::getQueryJoin();
        $joinList['address'] = "JOIN addresses  ON addresses.id = customers.address_id";
        $joinList['shipping_address'] = "JOIN addresses as shipping_addresses  ON shipping_addresses.id = customers.shipping_address_id";
        return $joinList;

    }

}
