<?php
/**
 * Blank Theme Admin loads from here.
 * @package Blank Theme
 */

//Enter the path where you have put the admin folder.
define( 'BLANK_THEME_ADMIN_FOLDER_PATH', '/admin' );

define( 'BLANK_THEME_ADMIN_DIR' , get_template_directory() . BLANK_THEME_ADMIN_FOLDER_PATH );
define( 'BLANK_THEME_ADMIN_URI' , get_template_directory_uri() . BLANK_THEME_ADMIN_FOLDER_PATH );
define( 'BLANK_THEME_CUSTOMIZER_URI' , BLANK_THEME_ADMIN_DIR . '/customizer' );
define( 'BLANK_THEME_CUSTOMIZER_DIR' , BLANK_THEME_ADMIN_DIR . '/customizer' );
define( 'BLANK_THEME_CUSTOMIZER_JS' , BLANK_THEME_ADMIN_URI . '/customizer/js' );
define( 'BLANK_THEME_CUSTOMIZER_CSS' , BLANK_THEME_ADMIN_URI . '/customizer/css' );
define( 'BLANK_THEME_KIRKI_DIR' , BLANK_THEME_ADMIN_DIR . '/kirki' );

$files_to_include = array(

	//Customzier
	BLANK_THEME_CUSTOMIZER_DIR . '/customizer-functions.php',
	BLANK_THEME_CUSTOMIZER_DIR . '/class.customizer-init.php',
	BLANK_THEME_CUSTOMIZER_DIR . '/class.customizer-front.php',

	//Kirki
	// BLANK_THEME_KIRKI_DIR . '/kirki.php',
	// BLANK_THEME_KIRKI_DIR . '/kirki-settings.php',

);

//Loading Files
foreach ( $files_to_include as $file_path ) {
	if ( file_exists( $file_path ) ) {
		include_once $file_path;
	}
}
