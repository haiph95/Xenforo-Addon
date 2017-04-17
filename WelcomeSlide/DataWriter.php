<?php

class HaiPham_WelcomeSlide_DataWriter extends XenForo_DataWriter
{
    /**
     * @return array
     */
    public function _getFields()
    {
        return array(
            'xf_tct_slide' => array(
                'slide_id'    => array(
                    'type' => self::TYPE_UINT,
                    'autoIncrement' => true
                ),
                'images' => array(
                    'type' => self::TYPE_STRING,
                    'required' => true
                ),
                'links' => array(
                    'type' => self::TYPE_STRING
                ),
                'is_show' => array(
                    'type' => self::TYPE_BOOLEAN,
                    'required' => true
                )
            )
        );
    }

    /**
     * @param $data
     * @return array|bool
     */
    public function _getExistingData($data)
    {
        if (!$id = $this->_getExistingPrimaryKey($data, 'slide_id'))
        {
            return false;
        }
        return array(
            'xf_tct_slide' => $this->_getSlideModel()->getSlideByID($id)
        );
    }

    /**
     * @param $tableName
     * @return string
     */
    public function _getUpdateCondition($tableName)
    {
        return 'slide_id = ' . $this->_db->quote($this->getExisting('slide_id'));
    }

    /**
     * @return XenForo_Model
     */
    protected function _getSlideModel()
    {
        return $this->getModelFromCache('HaiPham_WelcomeSlide_Model');
    }
}