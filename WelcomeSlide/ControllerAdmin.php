<?php


class HaiPham_WelcomeSlide_ControllerAdmin extends XenForo_ControllerAdmin_Abstract
{
    /**
     * @return XenForo_ControllerResponse_View
     */
    public function actionIndex()
    {
        return $this->responseView('HaiPham_WelcomeSlide_ViewAdmin', 'HP_listSlide', array(
            'slides' => $this->getModelSlide()->getAllSlide(),
        ));
    }


    /**
     * @return XenForo_Model
     */
    protected function getModelSlide()
    {
        return $this->getModelFromCache('HaiPham_WelcomeSlide_Model');
    }
}