<?php


class HaiPham_TctGroup_Installer
{
    public static function up()
    {
        XenForo_Application::getDb()->query('
            CREATE TABLE IF NOT EXISTS xf_group_level (
                level_id INT (10) NOT NULL AUTO_INCREMENT,
                level_name VARCHAR (255) NOT NULL,
                level_css VARCHAR (255),
                level_parent INT (10),
                create_at INT (10),
                PRIMARY KEY (level_id)
            );
        ');
    }

    public static function down()
    {
        XenForo_Application::getDb()->query("
            DROP TABLE IF EXISTS xf_group_level;
        ");
    }
}