<?php

class HaiPham_Auto_Route implements XenForo_Route_Interface
{
    public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
    {
//        $actions = $router->resolveActionWithStringParam();
        return $router->getRouteMatch('HaiPham_Auto_Controller', $routePath, 'forums');
    }
}