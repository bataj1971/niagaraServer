<?php

namespace Models;
use DataModel\DbModel;

/**
 * 
 */
trait AddressHandler
{

    protected DbModel $addressDataModel;
    
    protected function initAddressHandler()
    {
        $this->addressDataModel = new DbModel('Address');
    }
   
    /**
     * 
     */
    protected function insertAddress(
            array $parameters,
            string $addresNodeName,
            string $addresIdFieldname
            )
    {
        if (!empty($parameters[$addresNodeName]))
        {
            $address = $this->addressDataModel->insertRecord($parameters[$addresNodeName]);
            $parameters[$addresIdFieldname] = $address['id'];
            unset($parameters[$addresNodeName]);
        }
        
        return $parameters;
    }

    protected function deleteAddress(
            array $parameters,
            string $addresNodeName,
            string $addresIdFieldname                        
    )
    {       
        // if address node not set no todos:
        $currentRecordData = $this->getCurrentRecordData($parameters);
        $currentAddressId = $currentRecordData [$addresIdFieldname];
        

        if ( $currentAddressId )
        {
            $this->addressDataModel->deleteRecord(['id' => $currentAddressId ?? null]);            
        }

        return $parameters;    
    }
    
    protected function getAddress(
            array $parameters,
            string $addresNodeName,
            string $addresIdFieldname            
    )
    {
        if ($parameters[$addresIdFieldname])
        {
            $address = $this->addressDataModel->getRecord(['id' => $parameters[$addresIdFieldname] ?? null]);
            $parameters[$addresNodeName] = $address;
        }

        return $parameters;
    }


    /**
     * 
     * @param array $parameters
     * @return array
     * ($parameters, $addressId ,'address','addtess_id');   
     */
    protected function updateAddress(
            array $parameters,
            string $addresNodeName,
            string $addresIdFieldname
    ): array
    {
        // if address node not set no todos:
        if (!isset($parameters[$addresNodeName]))
        {
            return $parameters;
        }

        $currentRecordData = $this->getCurrentRecordData($parameters);
        $currentAddressId = $currentRecordData [$addresIdFieldname];

        $addressNode = $parameters[$addresNodeName];
        unset($parameters[$addresNodeName]);

        // if node is bool and false - delete address record and nullify reference
        if ($addressNode === false)
        {
            if ($currentAddressId)
            {
                $addressParameters = ['id' => $currentAddressId];
                $this->addressDataModel->deleteRecord($addressParameters);
            }

            $parameters[$addresIdFieldname] = 0;
            return $parameters;
        }


        // if currently address record connected
        if ($currentAddressId)
        {
            $addressParameters = array_merge($addressNode, ["id" => $currentAddressId]);
            $address = $this->addressDataModel->updateRecord($addressParameters);
        } else
        {
            $address = $this->addressDataModel->insertRecord($addressNode);
            $parameters[$addresIdFieldname] = $address['id'];
        }


        return $parameters;
    }

}
