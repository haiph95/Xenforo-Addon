<?php 

class HaiPham_TctGroup_Listener
{
    /**
     * Template to show group
     * @param $hookName
     * @param $contents
     * @param array $hookParams
     * @param XenForo_Template_Abstract $template
     */
	public static function actionTemplate($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
	{

        if ( $hookName == 'member_view_sidebar_middle2')
        {
            $options = XenForo_Application::get('options')->tctShowOptionGroup;
            $users = $template->getParam('user');

            $usergroups = $users['user_group_id'];

            if (!empty($users['secondary_group_ids']))
            {
                $usergroups .= ','.$users['secondary_group_ids'];
            }

            unset($users);

            static $groupModel = null;

            if ($groupModel === null) {
                $groupModel = XenForo_Model::create('XenForo_Model_UserGroup');
            }


            $usergroups = explode(',', $usergroups);

            $groups = array();

            foreach ($usergroups as $usergroup) {
                if (in_array($usergroup, $options)) {
                    $groups[] = $groupModel->getUserGroupById($usergroup);
                }
            }

            $contents = $template->create('member_group', array(
                'groups' => $groups,
            ))->render();
        }
	}




}