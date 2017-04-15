<?php


class HaiPham_SimpleText_Prefix implements XenForo_Route_Interface
{
    public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
    {
        $actions = $router->resolveActionWithIntegerParam($routePath, $request, 'simple_id');

        return $router->getRouteMatch('HaiPham_SimpleText_ControllerPublic_SimpleText', $actions, 'simpletext');
    }

    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        return XenForo_Link::buildBasicLinkWithIntegerParam($outputPrefix, $action, $extension, $data, 'simple_id');
    }
}