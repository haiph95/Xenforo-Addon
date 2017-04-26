<?php


class HaiPham_Auto_Listener
{
    /**
     * @param array $extraTabs
     * @param $selectedTabId
     */
    public static function tab(array &$extraTabs, $selectedTabId)
    {
        if (XenForo_Visitor::getInstance()['permissions']['AutoLeech']['list']) {

            $extraTabs['auto-leech'] = [
                'title' => new XenForo_Phrase('auto_leech'),

                'href' => XenForo_Link::buildPublicLink('auto-leech'),

                'position' => 'end',

                'selected' => ($selectedTabId == 'auto-leech'),

                'linksTemplate' => 'AutoLeech_Tab'
            ];
        }

    }



}