<?php

/**
 * Rtp customizer loads from here.
 */

define( 'BLANK_THEME_CUSTOMIZER_JS' , get_template_directory_uri() . BLANK_THEME_ADMIN_FOLDER_PATH . 'customizer/js' );
define( 'BLANK_THEME_CUSTOMIZER_CSS' , get_template_directory_uri() . BLANK_THEME_ADMIN_FOLDER_PATH . 'customizer/css' );

require_once BLANK_THEME_CUSTOMIZER_PATH . 'extensions/fonts.php';
require_once BLANK_THEME_CUSTOMIZER_PATH . 'class.customizer-init.php';
require_once BLANK_THEME_CUSTOMIZER_PATH . 'class.customizer-admin.php';
require_once BLANK_THEME_CUSTOMIZER_PATH . 'class.customizer-front.php';