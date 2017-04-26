<?php

class HaiPham_Auto_Model extends XenForo_Model
{
    public function canViewListAuto(array $user = null)
    {
        $this->standardizeViewingUserReference($user);

        return XenForo_Permission::hasPermission($user['permission'], 'AutoLeech', 'list');
    }
}