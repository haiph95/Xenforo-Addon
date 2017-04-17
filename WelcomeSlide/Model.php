<?php


class HaiPham_WelcomeSlide_Model extends XenForo_Model
{
    /**
     * Find by ID
     * @param $id
     * @return array
     */
    public function getSlideByID($id)
    {
        return $this->_getDb()->fetchRow(
            'SELECT * FROM xf_tct_slide WHERE slide_id = ?', $id
        );
    }

    /**
     * Find All
     * @return array
     */
    public function getAllSlide()
    {
        return $this->_getDb()->fetchAll("
            SELECT * FROM xf_tct_slide ORDER BY slide_id DESC 
        ");
    }

    public function getActiveSlide()
    {
        return $this->_getDb()->fetchAll("
            SELECT links, images FROM xf_tct_slide WHERE is_show = 1 ORDER BY slide_id DESC 
        ");
    }
}