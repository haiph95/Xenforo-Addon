<?php

class HaiPham_TctGroup_ControllerAdmin_GroupLevel extends XenForo_ControllerAdmin_Abstract
{
    /**
     * @param $action
     */
    protected function _preDispatch($action)
    {
        $this->assertAdminPermission('userGroup');
    }

    public function actionIndex()
    {
        $group = $this->_getUserGroupModel()->getAllUserGroupTitles();

        $groups = array();



        $levels = $this->_getUserLevelModel()->getAllLevel();
        $view = array(
            'levels' => $levels,
        );
        return $this->responseView('HaiPham_TctGroup_UserGroup_Level', 'user_group_level_list', $view);
    }

    public function actionAdd()
    {
        $param = array(
            'level' => array()
        );
        return $this->responseView('HaiPham_TctGroup_UserGroup_Level', 'user_group_level_edit', $param);
    }

    public function actionEdit()
    {
        $levelID = $this->_input->filterSingle('level_id', XenForo_Input::INT);

        if ($this->isConfirmedPost()) {
            var_dump(1);die;
        }

        $level = $this->_getUserLevelModel()->getLevelById($levelID);
        unset($levelID);
        $param = array(
            'level' => $level
        );
        return $this->responseView('HaiPham_TctGroup_UserGroup_Level', 'user_group_level_edit', $param);
    }


    public function actionSave()
    {
        $this->_assertPostOnly();

        $input = $this->_input->filter(array(
            'level_parent' => XenForo_Input::STRING,
            'level_name' => XenForo_Input::STRING,
            'level_css' => XenForo_Input::STRING
        ));

        $dw = XenForo_DataWriter::create('HaiPham_TctGroup_DataWriter_GroupLevel');

        $dw->set('level_parent', $input['level_parent']);
        $dw->set('level_name', $input['level_name']);
        $dw->set('level_css', $input['level_css']);

        $dw->save();

        return $this->responseRedirect(
            XenForo_ControllerResponse_Redirect::SUCCESS,
            $this->getDynamicRedirect()
        );
    }

    public function actionDelete()
    {
        if ($this->isConfirmedPost()) {
            return $this->_deleteData(
                'HaiPham_TctGroup_DataWriter_GroupLevel',
                'level_id',
                XenForo_Link::buildAdminLink('user-group-level')
            );
        } else {
            $level = $this->_getLevelOrError($this->_input->filterSingle('level_id', XenForo_Input::INT));

            $view = array(
                'level' => $level,
            );

            return $this->responseView('HaiPham_TctGroup_UserGroup_Level', 'user_group_level_delete', $view);
        }
    }


    protected function _getLevelOrError($id)
    {
        $level = $this->_getUserLevelModel()->getLevelById($id);
        if (!$level)
        {
            throw $this->responseException($this->responseError(new XenForo_Phrase('requested_not_found'), 404));
        }

        return $level;
    }

    public function _getUserLevelModel()
    {
        return $this->getModelFromCache('HaiPham_TctGroup_Model_GroupLevel');
    }


    protected function _getPermissionModel()
    {
        return $this->getModelFromCache('XenForo_Model_Permission');
    }

    protected function _getUserGroupModel()
    {
        return $this->getModelFromCache('XenForo_Model_UserGroup');
    }
}