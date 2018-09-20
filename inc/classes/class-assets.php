<?php
/**
 * Enqueue theme assets.
 *
 * @package blank-theme
 */

namespace Blank_Theme;

class Assets extends Base {

	/**
	 * Hold asset path.
	 *
	 * @var array
	 */
	public static $asset_paths = array();

	/**
	 * Get asset path.
	 *
	 * @return array
	 */
	public static function get_asset_path() {
		if ( ! empty( self::$asset_paths ) ) {
			return self::$asset_paths;
		}

		ob_start();
		include_once get_template_directory() . '/build/manifest.json';
		$json_data = ob_get_clean();

		self::$asset_paths = ( $json_data ) ? json_decode( $json_data, true ) : [];

		return self::$asset_paths;
	}

	/**
	 * Retrive asset path.
	 *
	 * @param string $filename File name of which hash path retrive.
	 *
	 * @link https://danielshaw.co.nz/wordpress-cache-busting-json-hash-map/
	 *
	 * @return string|bool
	 */
	public static function asset_path( $filename ) {

		$asset_paths = self::get_asset_path();

		if ( ! empty( $asset_paths[ $filename ] ) ) {
			return BLANK_THEME_BUILD_URI . '/' . $asset_paths[ $filename ];
		}

		return false;

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
