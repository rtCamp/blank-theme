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

		$this->setup_hooks();
	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

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

		$this->register_script( 'blank-theme-main', 'js/main.js', [ 'jquery' ] );
		$this->register_script( 'blank-theme-home', 'js/home.js', [ 'blank-theme-main' ] );
		$this->register_script( 'blank-theme-single', 'js/single.js', [ 'blank-theme-main' ] );

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

		$this->register_style( 'blank-theme-main', 'css/main.css' );
		$this->register_style( 'blank-theme-home', 'css/home.css', [ 'blank-theme-main' ] );
		$this->register_style( 'blank-theme-single', 'css/single.css', [ 'blank-theme-main' ] );

		wp_enqueue_style( 'blank-theme-main' );

		if ( is_home() ) {
			wp_enqueue_style( 'blank-theme-home' );
		}

		if ( is_single() ) {
			wp_enqueue_style( 'blank-theme-single' );
		}
	}

	/**
	 * Get asset dependencies and version info from {handle}.asset.php if exists.
	 *
	 * @param string $file File name.
	 * @param array  $deps Script dependencies to merge with.
	 * @param string $ver  Asset version string.
	 *
	 * @return array
	 */
	public function get_asset_meta( $file, $deps = array(), $ver = false ) {
		$asset_meta_file = sprintf( '%s/js/%s.asset.php', untrailingslashit( BLANK_THEME_BUILD_DIR ), basename( $file, '.' . pathinfo( $file )['extension'] ) );
		$asset_meta      = is_readable( $asset_meta_file )
			? require $asset_meta_file
			: array(
				'dependencies' => array(),
				'version'      => $this->get_file_version( $file, $ver ),
			);

		$asset_meta['dependencies'] = array_merge( $deps, $asset_meta['dependencies'] );

		return $asset_meta;
	}

	/**
	 * Register a new script.
	 *
	 * @param string           $handle    Name of the script. Should be unique.
	 * @param string|bool      $file       script file, path of the script relative to the assets/build/ directory.
	 * @param array            $deps      Optional. An array of registered script handles this script depends on. Default empty array.
	 * @param string|bool|null $ver       Optional. String specifying script version number, if not set, filetime will be used as version number.
	 * @param bool             $in_footer Optional. Whether to enqueue the script before </body> instead of in the <head>.
	 *                                    Default 'false'.
	 * @return bool Whether the script has been registered. True on success, false on failure.
	 */
	public function register_script( $handle, $file, $deps = array(), $ver = false, $in_footer = true ) {

		$src        = sprintf( BLANK_THEME_BUILD_URI . '/%s', $file );
		$asset_meta = $this->get_asset_meta( $file, $deps );

		return wp_register_script( $handle, $src, $asset_meta['dependencies'], $asset_meta['version'], $in_footer );
	}

	/**
	 * Register a CSS stylesheet.
	 *
	 * @param string           $handle Name of the stylesheet. Should be unique.
	 * @param string|bool      $file    style file, path of the script relative to the assets/build/ directory.
	 * @param array            $deps   Optional. An array of registered stylesheet handles this stylesheet depends on. Default empty array.
	 * @param string|bool|null $ver    Optional. String specifying script version number, if not set, filetime will be used as version number.
	 * @param string           $media  Optional. The media for which this stylesheet has been defined.
	 *                                 Default 'all'. Accepts media types like 'all', 'print' and 'screen', or media queries like
	 *                                 '(orientation: portrait)' and '(max-width: 640px)'.
	 *
	 * @return bool Whether the style has been registered. True on success, false on failure.
	 */
	public function register_style( $handle, $file, $deps = array(), $ver = false, $media = 'all' ) {

		$src        = sprintf( BLANK_THEME_BUILD_URI . '/%s', $file );
		$asset_meta = $this->get_asset_meta( $file, $deps );

		return wp_register_style( $handle, $src, $asset_meta['dependencies'], $asset_meta['version'], $media );
	}

	/**
	 * Get file version.
	 *
	 * @param string             $file File path.
	 * @param int|string|boolean $ver  File version.
	 *
	 * @return bool|false|int
	 */
	public function get_file_version( $file, $ver = false ) {
		if ( ! empty( $ver ) ) {
			return $ver;
		}

		$file_path = sprintf( '%s/%s', BLANK_THEME_BUILD_DIR, $file );

		return file_exists( $file_path ) ? filemtime( $file_path ) : false;
	}

}
