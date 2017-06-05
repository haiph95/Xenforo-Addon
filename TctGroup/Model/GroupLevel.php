<?php


class HaiPham_TctGroup_Model_GroupLevel extends XenForo_Model
{
    /**
     * @param $id
     * @return array
     */
    public function getLevelById($id)
    {
        return $this->_getDb()->fetchRow(
            'SELECT * FROM xf_group_level WHERE level_id = ?', $id
        );
    }

    /**
     * @return array
     */
    public function getAllLevel()
    {
        return $this->fetchAllKeyed(
            "SELECT * FROM xf_group_level", 'level_id'
        );
    }
}