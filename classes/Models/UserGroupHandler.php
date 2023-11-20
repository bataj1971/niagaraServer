<?php

namespace Models;

use DataModel\DbModel;

/**
 * 
 */
trait UserGroupHandler
{
    /** @var mixed $memberOfGroupDataModel */
    protected DbModel $memberOfGroupDataModel;

    /**
     * initUserGroupHandler
     *
     * @return void
     */
    protected function initUserGroupHandler()
    {
        $this->memberOfGroupDataModel = new DbModel('MemberOfGroup');
    }

    /**
     * getUserGroups
     *
     * @param  array $parameters
     * @return void
     */
    public function getUserGroups(array $parameters):array
    {
        $userId = $parameters['id'] ?? '';
        // $userGroups = $this->memberOfGroupDataModel->processGetList(["user_id"=> $userId]);
        $userGroups = $this->getGroupIdListForUser($userId);
        return $userGroups;
    }

    /**
     * addUserToGrop
     *
     * @param  array $parameters
     * @return void
     */
    protected function addUserToGrop(array $parameters)
    {

        return $parameters;
    }

    /**
     * removeUserFromGrop
     *
     * @return void
     */
    protected function removeUserFromGrop(
        array $parameters

    ) {
        $currentRecordData = $this->getCurrentRecordData($parameters);
        return $parameters;
    }

    /**
     * removeGroupMembership
     *
     * @param  mixed $parameters
     * @return void
     */
    protected function removeGroupMembership($parameters)
    {
        // TODO :
        // gather all groupmemberhips
        // delete them
        return $parameters;
    }

    
    /**
     * setUserGroups
     *
     * @return void
     */
    protected function setUserGroups(
        array $parameters,
        array $newGroupIdList,
        array $oldGroupIdList
    ): bool {

        $userId = $parameters['id'] ?? '';
        foreach ($newGroupIdList as $newGroupId) {
            if (!in_array($newGroupId, $oldGroupIdList)) {
                $groupInsertParams = [
                    "user_id" => $userId,
                    "group_id" => $newGroupId
                ];
                $this->memberOfGroupDataModel->processInsertRecord($groupInsertParams);
            }
        }

        foreach ($oldGroupIdList as $oldGroupId) {
            if (!in_array($oldGroupId, $newGroupIdList)) {
                $groupDeleteParams = [
                    "user_id" => $userId,
                    "group_id" => $oldGroupId
                ];
                $this->memberOfGroupDataModel->processDeleteRecord($groupDeleteParams);
            }
        }

        return true;
    }
    
    /**
     * getGroupIdListForUser
     *
     * @param  string $userId
     * @return array
     */
    public function getGroupIdListForUser(string $userId = ''): array
    {
        $values = ['userId' => $userId];
        $sql = "SELECT g.id as id
                FROM user_groups g
                JOIN member_of_group mg ON mg.group_id = g.id
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
