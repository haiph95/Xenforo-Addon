<?php


class HaiPham_WelcomeSlide_Listener
{

    /**
     * @param $hookName
     * @param $contents
     * @param array $hookParams
     * @param XenForo_Template_Abstract $template
     * @return XenForo_Template_Abstract
     */
    public static function actionTemplate($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
    {
        if ($hookName == 'page_container_notices')
        {
            static $slideModel = null;
            if ($slideModel === null) {
                $slideModel = XenForo_Model::create('HaiPham_WelcomeSlide_Model');
            }
            $slides = $slideModel->getActiveSlide();

            $view = array(
                'slides' => $slides
            );




            $contents .= $template->create('slide_header', $view);

        }
    }
}