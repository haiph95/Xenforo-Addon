<?php

class HaiPham_WelcomeSlide_AdminPrefix implements XenForo_Route_Interface
{

    /**
     * @param $routePath
     * @param Zend_Controller_Request_Http $request
     * @param XenForo_Router $router
     * @return string
     */
    public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
    {
        $actions = $router->resolveActionWithStringParam($routePath, $request, 'id');

        return $router->getRouteMatch('HaiPham_WelcomeSlide_ControllerAdmin', $actions, 'stylesAndTemplates');
    }

    /**
     * @param $originalPrefix
     * @param $outputPrefix
     * @param $action
     * @param $extension
     * @param $data
     * @param array $extraParams
     * @return false|string
     */
    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        return XenForo_Link::buildBasicLinkWithIntegerParam($outputPrefix, $action, $extension, $data, 'id');
    }
}