<?php


class HaiPham_Auto_Controller extends XenForo_ControllerPublic_Abstract
{
    public function actionIndex()
    {
        if (!XenForo_Visitor::getInstance()['permissions']['AutoLeech']['list']) {
            throw $this->getNoPermissionResponseException();
        }
        return $this->responseView('HaiPham_Auto_ViewPublic', 'auto_leech');
    }

    public function actionSend()
    {
        $this->_assertPostOnly();

        $input = $this->_input->filter([
            'url' => XenForo_Input::STRING,
            'thread' => XenForo_Input::STRING,

            '_set' => array(XenForo_Input::UINT, 'array' => true),

        ]);


        $input['thread'] = HaiPham_Auto_Helper::extracNum($input['thread']);



        $chap = new HaiPham_Auto_Chap($input['url']);

        $input['message'] = $chap->getMessages();

        HaiPham_Auto_Helper::dwPost($input);


        $redirectParams = array(
            'url' => $chap->getNextUrl(),
            'title' => $chap->getTitle(),
        );

        $msg = null;

        if ($chap->getNextUrl()=='') {
            $msg = 'Leech truyện hoàn tất';
        }

        return $this->responseRedirect(
            XenForo_ControllerResponse_Redirect::SUCCESS,
            XenForo_Link::buildPublicLink('auto-leech/send'),
            $msg,
            $redirectParams
        );

        /*return $this->responseView(
            'HaiPham_Auto_ViewPublic',
            'auto_leech',
            $viewParams
        );*/

    }

    protected function _getAutoModel()
    {
        $this->getModelFromCache('HaiPham_Auto_Model');
    }


    protected function _getModelThread()
    {
        $this->getModelFromCache('XenForo_Model_Thread');
    }

    protected function _getModelPost()
    {
        $this->getModelFromCache('XenForo_Model_Post');
    }
}