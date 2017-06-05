<?php


class HaiPham_TctGroup_Prefix_Admin implements XenForo_Route_Interface
{

    /**
     * Method to be called when attempting to match this rule against a routing path.
     * Should return false if no matching happened or a {@link XenForo_RouteMatch} if
     * some level of matching happened. If no {@link XenForo_RouteMatch::$controllerName}
     * is returned, the {@link XenForo_Router} will continue to the next rule.
     *
     * @param string                       Routing path
     * @param Zend_Controller_Request_Http Request object
     * @param XenForo_Router                  Router that routing is done within
     *
     * @return false|XenForo_RouteMatch
     */
    public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
    {
        $action = $router->resolveActionWithIntegerParam($routePath, $request, 'level_id');

        return $router->getRouteMatch('HaiPham_TctGroup_ControllerAdmin_GroupLevel', $action, 'userGroups');
    }

    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        return XenForo_Link::buildBasicLinkWithIntegerParam($outputPrefix, $action, $extension, $data, 'level_id');
    }
}