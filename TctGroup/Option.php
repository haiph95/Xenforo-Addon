<?php

/**
* 
*/
class HaiPham_TctGroup_Option 
{
    /**
     * @param XenForo_View $view
     * @param $fieldPrefix
     * @param array $preparedOption
     * @param $canEdit
     * @return mixed
     */
	public static function renderOption(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
    {

        $preparedOption['formatParams'] = XenForo_Model::create('HaiPham_TctGroup_GetUserGroup')->getUserGroupOptions(
            $preparedOption['option_value']
        );

        return XenForo_ViewAdmin_Helper_Option::renderOptionTemplateInternal(
        'option_list_option_checkbox',
            $view, $fieldPrefix, $preparedOption, $canEdit
        );

    }
}