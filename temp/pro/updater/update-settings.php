<?php
/**
 * Contains settings for the premimum theme.
 * This is the only file which needs to be changed.
 * Other udpater files are not supposed to be altered.
 */

/*==============================
	CHANGE FOR EVERY LICENCE
===============================*/

/*---------------------------
	 Personal Licence
---------------------------*/

define( 'BLANK_THEME_PRO_LICENCE_TYPE' , 'Personal' );
define( 'BLANK_THEME_PRO_ITEM_NAME', 'blank-theme-pro-personal-license' );

/*---------------------------
	 Personal Lifetime
---------------------------*/

// define( 'BLANK_THEME_PRO_LICENCE_TYPE' , 'Personal Lifetime'  );
// define( 'BLANK_THEME_PRO_ITEM_NAME', 'blank-theme-pro-personal-lifetime-licence' );

/*---------------------------
	Developer License
---------------------------*/

// define( 'BLANK_THEME_PRO_LICENCE_TYPE' , 'Developer'  );
// define( 'BLANK_THEME_PRO_ITEM_NAME', 'blank-theme-pro-developer-licence' );

/*==============================
          DEFINITIONS
===============================*/

// our store URL that is running EDD
define( 'BLANK_THEME_PRO_REMOTE_URL', 'http://blanktheme.com/' );

//Theme Version
define( 'BLANK_THEME_PRO_VERSION_NUMBER', BLANK_THEME_PRO_VERSION );

//Theme Author
define( 'BLANK_THEME_PRO_AUTHOR' , 'rtCamp' );

//Will be used in the licence activation file for several things
define( 'BLANK_THEME_PRO_PREFIX' , 'blank_theme_pro' );

/*==============================
          FILE INCLUDES
===============================*/

if ( ! class_exists( 'EDD_SL_Theme_Updater' ) ) {
	require_once BLANK_THEME_PRO_DIR . '/updater/EDD_SL_Theme_Updater.php';
}

require_once BLANK_THEME_PRO_DIR . '/updater/licence-activation.php';
