<?php


class HaiPham_WelcomeSlide_Installer
{
    public static function up()
    {
        XenForo_Application::get('db')->query("
            CREATE TABLE IF NOT EXISTS xf_tct_slide (
              id INT (10) NOT NULL AUTO_INCREMENT,
              images VARCHAR (254) NULL,
              links VARCHAR (254) NULL,
              is_show INT NOT NULL,
              PRIMARY KEY (id)
            )
        ");
    }

    public static function down()
    {
        XenForo_Application::get('db')->query("
            DROP TABLE IF EXISTS xf_tct_slide
        ");
    }
}