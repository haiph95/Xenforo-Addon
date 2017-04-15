<?php

/**
 * Class HaiPham_TctGroup_GetUserGroup
 */
class HaiPham_TctGroup_GetUserGroup extends XenForo_Model
{
    /**
     * @param $selectedGroupIds
     * @return array
     */
	public function getUserGroupOptions($selectedGroupIds)
    {

        $userGroups = array();
        foreach ($this->getAppropriateUserGroups() as $userGroup)
        {
            $userGroups[] = array(
                'label' => $userGroup['title'],
                'value' => $userGroup['user_group_id'],
                'selected' => in_array($userGroup['user_group_id'], $selectedGroupIds)
            );
        }

        return $userGroups;

    }

    /**
     * @return array
     */
    public function getAppropriateUserGroups()
    {
        return $this->_getDb()->fetchAll('
            SELECT user_group_id, title, username_css, user_title
            FROM xf_user_group
            WHERE user_group_id = 2 OR user_group_id > 4
            ORDER BY user_group_id
        ');

    }

    public static function getUserGroupByID()
    {
        //
    }
}