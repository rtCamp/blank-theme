<?php
/**
 * Blank Theme file includes and definitions
 *
 * @package Blank-Theme
 */

namespace Blank_Theme;

if ( ! defined( 'BLANK_THEME_VERSION' ) ) {
	define( 'BLANK_THEME_VERSION', 2.0 );
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
require_once BLANK_THEME_TEMP_DIR . '/inc/custom-functions.php';
require_once BLANK_THEME_TEMP_DIR . '/inc/template-tags.php';

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

do_action( 'blank_theme_after' );
