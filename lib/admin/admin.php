<?php
/**
 * Rtp admin loads from here.
 * @package Blank Theme
 */

//Enter the path where you have put the admin folder.
define( 'BLANK_THEME_ADMIN_FOLDER_PATH', '/lib/admin/' );

define( 'BLANK_THEME_ADMIN_PATH' , get_template_directory() . BLANK_THEME_ADMIN_FOLDER_PATH );
define( 'BLANK_THEME_ADMIN_URI' , get_template_directory_uri() . BLANK_THEME_ADMIN_FOLDER_PATH );
define( 'BLANK_THEME_CUSTOMIZER_PATH' , BLANK_THEME_ADMIN_PATH . 'customizer/' );

//Loading Files
require_once BLANK_THEME_CUSTOMIZER_PATH . 'customizer.php';