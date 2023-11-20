<?php
namespace Models;

use DataModel\DbModel;
use Models\AddressHandler;

/**
 * Description of UserModel
 *
 * @author Bata Jozsef 
 */
class UserModel extends DbModel
{
    use AddressHandler;
    use UserGroupHandler;
    use UserRightHandler;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('User');

        $this->initAddressHandler();
        $this->initUserGroupHandler();
        $this->initUserRightHandler();
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
        // todo :
        // delete all group membership : member_of_group
        $this->removeGroupMembership($parameters);
        $this->memberOfGroupDataModel->processDeleteRecord();
        


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
        $id =        parent::processInsertRecord($parameters);
        $this->setUserGroups($id, $parameters['groups'] ?? [] , []);
        return $id;
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

        if ( isset($parameters['groups'])) {
            $currentGroupIdList = $this->getGroupIdListForUser($parameters['id']);
            $newGroupList = (empty($parameters['groups']) ? [] : $parameters['groups']);
            $this->setUserGroups($parameters, $newGroupList, $currentGroupIdList);
            unset($parameters['groups']);
        }
        return parent::processUpdateRecord($parameters);
    }

    
    /**
     * getQueryFieldList
     *
     * @return void
     */
    protected function getQueryFieldList():array
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

        $fieldList['rights'] = "            
            (SELECT JSON_ARRAYAGG(			
                JSON_OBJECT(
                    'id',r.id,
                    'name',r.name,                    
                    'level',hr.level
                )
            )
            FROM user_rights r
            JOIN has_right hr ON hr.right_id = r.id
            JOIN member_of_group mg ON mg.group_id = hr.group_id                
            WHERE mg.user_id = users.id
            )        
        ";

        $fieldList['groups'] = "            
            (SELECT JSON_ARRAYAGG(			
                JSON_OBJECT(
                    'id',g.id,
                    'name',g.name                    
                )
            )
            FROM user_groups g
            JOIN member_of_group mg ON mg.group_id = g.id
            WHERE mg.user_id = users.id      
            )        
        ";        
        return $fieldList;

    }
    
    /**
     * getQueryJoin
     *
     * @return array
     */
    protected function getQueryJoin() :array

    {
        $joinList = parent::getQueryJoin();
        $joinList['address'] = "LEFT JOIN addresses  ON addresses.id = users.address_id";
        return $joinList;
    }

}
