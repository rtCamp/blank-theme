<?php

/*==============================
          Definitions
===============================*/

/*** BLANK_THEME_PRO_VERSION SHOULD BE CHANGED FOR EVERY PRO VERSION ***/
if( ! defined( 'BLANK_THEME_PRO_VERSION' )) define( 'BLANK_THEME_PRO_VERSION' , '1.0.0' );
if( ! defined( 'BLANK_THEME_PRO_DIR' )) define( 'BLANK_THEME_PRO_DIR'	, get_template_directory() . '/pro' );
if( ! defined( 'BLANK_THEME_PRO_URI' )) define( 'BLANK_THEME_PRO_URI' , get_template_directory_uri() . '/pro' );
if( ! defined( 'BLANK_THEME_PRO_IMAGES' )) define( 'BLANK_THEME_PRO_IMAGES'	, BLANK_THEME_PRO_URI .'/img' );

/*==============================
          File Includes
===============================*/

require_once BLANK_THEME_PRO_DIR . '/updater/update-settings.php';
require_once BLANK_THEME_PRO_DIR . '/custom-functions.php';
require_once BLANK_THEME_PRO_DIR . '/hooks.php';

add_action( 'wp_enqueue_scripts' , 'blank_theme_pro_enquque_scripts' );
function blank_theme_pro_enquque_scripts()
{
	wp_enqueue_style( 'blank_theme_pro_styles', BLANK_THEME_PRO_URI . '/pro.css' , array( 'blank-theme-style' ) , BLANK_THEME_PRO_VERSION );
	wp_enqueue_script( 'blank_theme_pro_scripts', BLANK_THEME_PRO_URI . '/js/pro.js' , array( 'jquery' ) , BLANK_THEME_PRO_VERSION, true );
}
