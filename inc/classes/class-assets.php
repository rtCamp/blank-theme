<?php
/**
 * Enqueue theme assets.
 *
 * @package Blank-Theme
 */

namespace BLANK_THEME\Inc;

use Blank_Theme\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Assets {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->_setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function _setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );

	}

	/**
	 * Register scripts.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_scripts() {

		wp_register_script( 'blank-theme-main', BLANK_THEME_BUILD_URI . '/js/main.js', [ 'jquery' ], false, true );
		wp_register_script( 'blank-theme-home', BLANK_THEME_BUILD_URI . '/js/home.js', [ 'jquery' ], false, true );
		wp_register_script( 'blank-theme-single', BLANK_THEME_BUILD_URI . '/js/single.js', [ 'jquery' ], false, true );

		wp_enqueue_script( 'blank-theme-main' );

		if ( is_home() ) {
			wp_enqueue_script( 'blank-theme-home' );
		}

		if ( is_single() ) {
			wp_enqueue_script( 'blank-theme-single' );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	/**
	 * Register styles.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_styles() {

		wp_register_style( 'blank-theme-main', BLANK_THEME_BUILD_URI . '/css/main.css', [] );
		wp_register_style( 'blank-theme-home', BLANK_THEME_BUILD_URI . '/css/home.css', [ 'blank-theme-main' ] );
		wp_register_style( 'blank-theme-single', BLANK_THEME_BUILD_URI . '/css/single.css', [ 'blank-theme-main' ] );

		wp_enqueue_style( 'blank-theme-main' );

		if ( is_home() ) {
			wp_enqueue_style( 'blank-theme-home' );
		}

		if ( is_single() ) {
			wp_enqueue_style( 'blank-theme-single' );
		}
	}

}
