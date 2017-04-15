<?php

class HaiPham_SimpleText_DataWriter_SimpleText extends XenForo_DataWriter
{
    /**
     * @return array
     */
    protected function _getFields()
    {
        return [

            'xf_simple_text' => [
                'simple_id' => [
                    'type'  => self::TYPE_UINT,
                    'autoIncrement' => true,
                ],
                'simple_text' => [
                    'type'  => self::TYPE_STRING,
                    'required' => true,
                ],
                'simple_date'    => [
                    'type'            => self::TYPE_UINT,
                    'required'        => false,
                    'default'        => XenForo_Application::$time,
                ]

            ]

        ];
    }

    /**
     * @param $data
     * @return array|bool
     */
    protected function _getExistingData($data)
    {
        if (!$id = $this->_getExistingPrimaryKey($data, 'simple_id'))
        {
            return false;
        }

        return [
            'xf_simple_text' => $this->getSimpleTextModel()->getSimpleTextByID($id),
        ];
    }

    /**
     * @param $tableName
     * @return mixed
     */
    protected function _getUpdateCondition($tableName)
    {
        return 'simple_id = ' . $this->_db->quote($this->getExisting("simple_id"));
    }

    /**
     * @return XenForo_Model
     */
    protected function getSimpleTextModel()
    {
        return $this->getModelFromCache('HaiPham_SimpleText_Model_SimpleText');
    }
}