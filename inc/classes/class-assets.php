<?php
/**
 * Enqueue theme assets.
 *
 * @package blank-theme
 */

namespace Blank_Theme;

class Assets extends Base {

	/**
	 * Register scripts.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_scripts() {

		wp_register_script( 'blank-theme-main', BLANK_THEME_BUILD_URI . '/js/main.js', array( 'jquery' ), BLANK_THEME_VERSION, true );
		wp_register_script( 'blank-theme-home', BLANK_THEME_BUILD_URI . '/js/home.js', array( 'jquery' ), BLANK_THEME_VERSION, true );
		wp_register_script( 'blank-theme-single', BLANK_THEME_BUILD_URI . '/js/single.js', array( 'jquery' ), BLANK_THEME_VERSION, true );

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

		wp_register_style( 'blank-theme-main', BLANK_THEME_BUILD_URI . '/css/main.css', array(), BLANK_THEME_VERSION );
		wp_register_style( 'blank-theme-home', BLANK_THEME_BUILD_URI . '/css/home.css', array( 'blank-theme-main' ), BLANK_THEME_VERSION );
		wp_register_style( 'blank-theme-single', BLANK_THEME_BUILD_URI . '/css/single.css', array( 'blank-theme-main' ), BLANK_THEME_VERSION );

		wp_enqueue_style( 'blank-theme-main' );

		if ( is_home() ) {
			wp_enqueue_style( 'blank-theme-home' );
		}

		if ( is_single() ) {
			wp_enqueue_style( 'blank-theme-single' );
		}
	}

}
