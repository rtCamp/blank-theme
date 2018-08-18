<?php
/**
 * Bootstraps the Theme.
 *
 * @package Blank_Theme
 */

namespace Blank_Theme;

/**
 * Main plugin bootstrap file.
 */
class Blank_Theme extends Base {

	/**
	 * Initiate the theme resources.
	 *
	 * @action after_setup_theme, 9
	 */
	public function init() {

	}

	/**
	 * Register scripts.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_scripts() {}

	/**
	 * Register styles.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_styles() {}
}
