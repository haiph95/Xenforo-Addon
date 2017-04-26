<?php


class HaiPham_SimpleText_Model_SimpleText extends XenForo_Model
{

    /**
     * Lấy data theo id
     * @param $id
     * @return array
     */
    public function getSimpleTextByID($id)
    {
        return $this->_getDb()->fetchRow(
            "select * from 'xf_simple_text' WHERE simple_id = ?", $id
        );
    }

    /**
     * Lấy từ trong model
     * @return mixed
     */
    public function getAllSimpleText()
    {
        return $this->fetchAllKeyed(
            "SELECT * FROM `xf_simple_text` ORDER BY `simple_date` DESC ", 'simple_id'
        );
    }
}