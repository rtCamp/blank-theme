<?php
/**
 * Enqueue theme assets.
 *
 * @package blank-theme
 */

namespace Blank_Theme;

class Assets extends Base {

	/**
	 * Retrive asset path.
	 *
	 * @param string $filename File name of which hash path retrive.
	 *
	 * @link https://danielshaw.co.nz/wordpress-cache-busting-json-hash-map/
	 *
	 * @return string
	 */
	public static function asset_path( $filename ) {

		ob_start();
		require_once get_template_directory() . '/build/manifest.json';
		$map = ob_get_clean();

		static $hash = null;

		if ( null === $hash ) {
			$hash = ( $map ) ? json_decode( $map, true ) : [];
		}

		if ( array_key_exists( $filename, $hash ) ) {
			return BLANK_THEME_BUILD_URI . '/' . $hash[ $filename ];
		}

		return BLANK_THEME_BUILD_URI . '/' . $filename;

	}

	/**
	 * Register scripts.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function register_scripts() {

		wp_register_script( 'blank-theme-main', self::asset_path( 'main.js' ), array( 'jquery' ), BLANK_THEME_VERSION, true );
		wp_register_script( 'blank-theme-home', self::asset_path( 'home.js' ), array( 'jquery' ), BLANK_THEME_VERSION, true );
		wp_register_script( 'blank-theme-single', self::asset_path( 'single.js' ), array( 'jquery' ), BLANK_THEME_VERSION, true );

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

		wp_register_style( 'blank-theme-main', self::asset_path( 'main.css' ), array(), BLANK_THEME_VERSION );
		wp_register_style( 'blank-theme-home', self::asset_path( 'home.css' ), array( 'blank-theme-main' ), BLANK_THEME_VERSION );
		wp_register_style( 'blank-theme-single', self::asset_path( 'single.css' ), array( 'blank-theme-main' ), BLANK_THEME_VERSION );

		wp_enqueue_style( 'blank-theme-main' );

		if ( is_home() ) {
			wp_enqueue_style( 'blank-theme-home' );
		}

		if ( is_single() ) {
			wp_enqueue_style( 'blank-theme-single' );
		}
	}

}
