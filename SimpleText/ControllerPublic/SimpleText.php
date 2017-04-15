<?php


class HaiPham_SimpleText_ControllerPublic_SimpleText extends XenForo_ControllerPublic_Abstract
{
    public function actionWrite()
    {
        $text = $this->_input->filterSingle('simple_text', XenForo_Input::STRING);

        $dw = XenForo_DataWriter::create('HaiPham_SimpleText_DataWriter_SimpleText');

        $dw->set('simple_text', $text);


        $dw->save();

        return $this->responseRedirect(
            XenForo_ControllerResponse_Redirect::SUCCESS,
            $this->getDynamicRedirect()
        );
    }

    public function actionRead()
    {
        $view = [
            'simpleText' => $this->_getSimpleTextModel()->getAllSimpleText(),
        ];

        return $this->responseView('XenForo_ViewPublic_Base', 'simpletext', $view);
    }

    protected function _getSimpleTextModel()
    {
        return $this->getModelFromCache('HaiPham_SimpleText_Model_SimpleText');
    }
}