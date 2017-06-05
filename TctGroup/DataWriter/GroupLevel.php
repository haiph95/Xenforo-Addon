<?php


class HaiPham_TctGroup_DataWriter_GroupLevel extends XenForo_DataWriter
{
    /**
     * @return array
     */
    protected function _getFields()
    {
        return [
            'xf_group_level' => [
                'level_id' => ['type' => self::TYPE_UINT, 'autoIncrement' => true],
                'level_name' => ['type' => self::TYPE_STRING, 'require' => true],
                'level_css' => ['type' => self::TYPE_STRING],
                'level_parent' => ['type'=> self::TYPE_INT, 'require' => true],
                'create_at' => ['type' => self::TYPE_INT, 'require' => false, 'default' => XenForo_Application::$time]
            ]
        ];
    }

    /**
     * @param $data
     * @return array|bool
     */
    protected function _getExistingData($data)
    {
        if (!$id = $this->_getExistingPrimaryKey($data)) {
            return false;
        }
        return ['xf_group_level' => $this->_getGroupLevelModel()->getLevelById($id)];
    }

    /**
     * @param $tableName
     * @return string
     */
    protected function _getUpdateCondition($tableName)
    {
        return 'level_id = ' . $this->_db->quote($this->getExisting('level_id'));
    }

    /**
     * @return XenForo_Model
     */
    protected function _getGroupLevelModel()
    {
        return $this->getModelFromCache('HaiPham_TctGroup_Model_GroupLevel');
    }
}