<?php


class HaiPham_WelcomeSlide_ControllerAdmin extends XenForo_ControllerAdmin_Abstract
{
    /**
     * @return XenForo_ControllerResponse_View
     */
    public function actionIndex()
    {
        $slides = $this->getModelSlide()->getAllSlide();
        return $this->responseView('HaiPham_WelcomeSlide_ViewAdmin', 'HP_listSlide', array(
            'slides' => $slides,
            'total' => count($slides),
        ));
    }

    /**
     * @return XenForo_ControllerResponse_Redirect
     */
    public function actionAdd()
    {
//        return $this->responseRedirect('HaiPham_Welcome_Slide_ViewAdmin', 'edit');
        $slide = array();
        return $this->_getEditResponsive($slide);
    }

    protected function _getEditResponsive(array $slide)
    {
        $view = array(
            'slide' => $slide
        );
        return $this->responseView('HaiPham_Welcome_Slide_ViewAdmin', 'Hp_listSlide_edit', $view);
    }


    public function actionEdit()
    {
        $slideId = $this->_input->filterSingle('slide_id', XenForo_Input::UINT);
        $slide = $this->getModelSlide()->getSlideByID($slideId);

        return $this->_getEditResponsive($slide);
    }

    public function actionSave()
    {
        $this->_assertPostOnly();

        $id = $this->_input->filterSingle('slide_id', XenForo_Input::UINT);

        $data = $this->_input->filter(array(
            'images' => XenForo_Input::STRING,
            'links'  => XenForo_Input::STRING,
            'is_show'   => XenForo_Input::BOOLEAN
        ));

        $writer = XenForo_DataWriter::create('HaiPham_WelcomeSlide_DataWriter');

        if ($id)  {
            $writer->setExistingData($id);
        }

        $writer->bulkSet($data);

        $writer->save();

        return $this->responseRedirect(
            XenForo_ControllerResponse_Redirect::SUCCESS,
            XenForo_Link::buildAdminLink('slide')
        );
    }

    /**
     * @return XenForo_ControllerResponse_Redirect|XenForo_ControllerResponse_View
     */
    public function actionDelete()
    {
        if ($this->isConfirmedPost()) {
            return $this->_deleteData('HaiPham_WelcomeSlide_DataWriter',
                                        'slide_id',
                                        XenForo_Link::buildAdminLink('slide')
                );
        } else {
            $id = $this->_input->filterSingle('slide_id', XenForo_Input::UINT);
            $slide = $this->_getSlideOrError($id);


            $viewParams = array(
                'slide' => $slide
            );

            return $this->responseView('HaiPham_Welcome_Slide_ViewAdmin', 'Hp_listSlide_delete', $viewParams);
        }
    }


    /**
     * @param $id
     * @return mixed
     * @throws XenForo_ControllerResponse_Exception
     */
    protected function _getSlideOrError($id)
    {
        $slide = $this->getModelSlide()->getSlideByID($id);
        if (!$slide)
        {
            throw $this->responseException($this->responseError(new XenForo_Phrase('requested_not_found'), 404));
        }

        return $slide;
    }


    /**
     * @return XenForo_Model
     */
    protected function getModelSlide()
    {
        return $this->getModelFromCache('HaiPham_WelcomeSlide_Model');
    }
}