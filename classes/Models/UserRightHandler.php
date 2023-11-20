<?php

namespace Models;

use DataModel\DbModel;

/**
 * 
 */
trait UserRightHandler
{    
    /** @var mixed $hasRightDataModel */
    protected DbModel $hasRightDataModel;
    
    /**
     * initUserRightHandler
     *
     * @return void
     */
    protected function initUserRightHandler()
    {
        $this->hasRightDataModel = new DbModel('HasRight');
    }
    
    /**
     * getUserRights
     *
     * @param  array $parameters
     * @return void
     */
    public function getUserRights(array $parameters) : array{
       $userId = $parameters['id'] ?? '';       
       $userGroups = $this->getRightNameListForUser( $userId);
       return $userGroups;
    }
    
    /**
     * getRightNameListForUser
     *
     * @param  string $userId
     * @return array
     */
    public function getRightNameListForUser(string $userId = ''): array
    {
        $values = ['userId' => $userId];
        $sql = "SELECT distinct r.id
                FROM user_rights r
                JOIN has_right gr ON gr.right_id = r.id
                JOIN member_of_group mg ON mg.group_id = gr.group_id                
                WHERE mg.user_id = :userId
        ";
        $recordSet = $this->db->query($sql, $values);
        $idList = [];
        foreach ($recordSet as $record) {
            array_push($idList, $record['id']);
        }
        return $idList;

    }


}