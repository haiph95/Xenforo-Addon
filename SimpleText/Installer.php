<?php

class HaiPham_SimpleText_Installer {

    /**
     * Query for create schema table
     *
     * @var array
     */
    protected static $table = [
        'up' => 'CREATE TABLE IF NOT EXISTS `xf_simple_text` (               
                `simple_id` INT( 10 ) NOT NULL AUTO_INCREMENT,
                `simple_text` VARCHAR ( 200 ),
                `simple_date` INT( 10 ) UNSIGNED,
                PRIMARY KEY (`simple_id`)
                )
            ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;',
        'down' => 'DROP TABLE IF EXISTS "xf_simple_text"',
    ];

    public static function install()
    {
        $db = XenForo_Application::get('db');
        $db->query(self::$table['up']);
    }

    public static function uninstall()
    {
        $db = XenForo_Application::get('db');
        $db->query(self::$table['down']);
    }
}