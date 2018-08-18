<?php
/**
 * Blank Theme functions and definitions
 *
 * @package blank-theme
 */

namespace Blank_Theme;

if ( ! defined( 'BLANK_THEME_VERSION' ) ) {
	define( 'BLANK_THEME_VERSION', 1.0 );
}
if ( ! defined( 'BLANK_THEME_TEMP_DIR' ) ) {
	define( 'BLANK_THEME_TEMP_DIR', get_template_directory() );
}
if ( ! defined( 'BLANK_THEME_BUILD_URI' ) ) {
	define( 'BLANK_THEME_BUILD_URI', get_template_directory_uri() . '/build' );
}

do_action( 'blank_theme_before' );

require_once BLANK_THEME_TEMP_DIR . '/inc/classes/class-base.php';
require_once BLANK_THEME_TEMP_DIR . '/inc/classes/class-blank-theme.php';

$blank_theme = new Blank_Theme();

/**
 * Get blank theme instance.
 *
 * @return Blank_Theme
 */
function get_theme_instance() {
	global $blank_theme;
	return $blank_theme;
}

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
