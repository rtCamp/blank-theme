<?php
/**
 * Blank Theme functions and definitions
 *
 * @package Blank Theme
 */

if ( ! defined( 'BLANK_THEME_VERSION' ) ) {
	define( 'BLANK_THEME_VERSION', 1.0 );
}
if ( ! defined( 'BLANK_THEME_TEMP_URI' ) ) {
	define( 'BLANK_THEME_TEMP_URI', get_template_directory_uri() );
}
if ( ! defined( 'BLANK_THEME_TEMP_DIR' ) ) {
	define( 'BLANK_THEME_TEMP_DIR', get_template_directory() );
}
if ( ! defined( 'BLANK_THEME_BUILD_URI' ) ) {
	define( 'BLANK_THEME_BUILD_URI', BLANK_THEME_TEMP_URI . '/build' );
}
if ( ! defined( 'BLANK_THEME_CSS_URI' ) ) {
	define( 'BLANK_THEME_CSS_URI', BLANK_THEME_TEMP_URI . '/css' );
}
if ( ! defined( 'BLANK_THEME_JS_URI' ) ) {
	define( 'BLANK_THEME_JS_URI', BLANK_THEME_TEMP_URI . '/js' );
}
if ( ! defined( 'BLANK_THEME_IMG_URI' ) ) {
	define( 'BLANK_THEME_IMG_URI', BLANK_THEME_TEMP_URI . '/img' );
}
if ( ! defined( 'BLANK_THEME_IS_DEV' ) ) {
	define( 'BLANK_THEME_IS_DEV', true );
}

do_action( 'blank_theme_before' );

require_once BLANK_THEME_TEMP_DIR . '/inc/classes/class-base.php';
require_once BLANK_THEME_TEMP_DIR . '/inc/classes/class-blank-theme.php';

new \Blank_Theme\Blank_Theme();

/**
 * FILE INCLUDES.
 */
$blank_theme_depedencies = apply_filters( 'blank_theme_depedencies', array(
	BLANK_THEME_TEMP_DIR . '/inc/*.php',
) );

foreach ( $blank_theme_depedencies as $path ) {
	foreach ( glob( $path ) as $filename ) {
		include $filename;
	}
}

do_action( 'blank_theme_after' );
