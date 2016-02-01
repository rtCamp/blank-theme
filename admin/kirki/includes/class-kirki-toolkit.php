<?php
/**
 * The main Kirki object
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2015, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Early exit if the class already exists
if ( class_exists( 'Kirki_Toolkit' ) ) {
	return;
}

final class Kirki_Toolkit {

	/** @var Kirki The only instance of this class */
	public static $instance = null;

	public static $version = '2.0.5';

	public $font_registry = null;
	public $scripts       = null;
	public $api           = null;
	public $styles        = array();

	/**
	 * Access the single instance of this class
	 * @return Kirki
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new Kirki_Toolkit();
		}
		return self::$instance;
	}

	/**
	 * Shortcut method to get the translation strings
	 */
	public static function i18n() {

		$i18n = array(
			'background-color'      => esc_attr__( 'Background Color', 'blank-theme' ),
			'background-image'      => esc_attr__( 'Background Image', 'blank-theme' ),
			'no-repeat'             => esc_attr__( 'No Repeat', 'blank-theme' ),
			'repeat-all'            => esc_attr__( 'Repeat All', 'blank-theme' ),
			'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'blank-theme' ),
			'repeat-y'              => esc_attr__( 'Repeat Vertically', 'blank-theme' ),
			'inherit'               => esc_attr__( 'Inherit', 'blank-theme' ),
			'background-repeat'     => esc_attr__( 'Background Repeat', 'blank-theme' ),
			'cover'                 => esc_attr__( 'Cover', 'blank-theme' ),
			'contain'               => esc_attr__( 'Contain', 'blank-theme' ),
			'background-size'       => esc_attr__( 'Background Size', 'blank-theme' ),
			'fixed'                 => esc_attr__( 'Fixed', 'blank-theme' ),
			'scroll'                => esc_attr__( 'Scroll', 'blank-theme' ),
			'background-attachment' => esc_attr__( 'Background Attachment', 'blank-theme' ),
			'left-top'              => esc_attr__( 'Left Top', 'blank-theme' ),
			'left-center'           => esc_attr__( 'Left Center', 'blank-theme' ),
			'left-bottom'           => esc_attr__( 'Left Bottom', 'blank-theme' ),
			'right-top'             => esc_attr__( 'Right Top', 'blank-theme' ),
			'right-center'          => esc_attr__( 'Right Center', 'blank-theme' ),
			'right-bottom'          => esc_attr__( 'Right Bottom', 'blank-theme' ),
			'center-top'            => esc_attr__( 'Center Top', 'blank-theme' ),
			'center-center'         => esc_attr__( 'Center Center', 'blank-theme' ),
			'center-bottom'         => esc_attr__( 'Center Bottom', 'blank-theme' ),
			'background-position'   => esc_attr__( 'Background Position', 'blank-theme' ),
			'background-opacity'    => esc_attr__( 'Background Opacity', 'blank-theme' ),
			'on'                    => esc_attr__( 'ON', 'blank-theme' ),
			'off'                   => esc_attr__( 'OFF', 'blank-theme' ),
			'all'                   => esc_attr__( 'All', 'blank-theme' ),
			'cyrillic'              => esc_attr__( 'Cyrillic', 'blank-theme' ),
			'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'blank-theme' ),
			'devanagari'            => esc_attr__( 'Devanagari', 'blank-theme' ),
			'greek'                 => esc_attr__( 'Greek', 'blank-theme' ),
			'greek-ext'             => esc_attr__( 'Greek Extended', 'blank-theme' ),
			'khmer'                 => esc_attr__( 'Khmer', 'blank-theme' ),
			'latin'                 => esc_attr__( 'Latin', 'blank-theme' ),
			'latin-ext'             => esc_attr__( 'Latin Extended', 'blank-theme' ),
			'vietnamese'            => esc_attr__( 'Vietnamese', 'blank-theme' ),
			'hebrew'                => esc_attr__( 'Hebrew', 'blank-theme' ),
			'arabic'                => esc_attr__( 'Arabic', 'blank-theme' ),
			'bengali'               => esc_attr__( 'Bengali', 'blank-theme' ),
			'gujarati'              => esc_attr__( 'Gujarati', 'blank-theme' ),
			'tamil'                 => esc_attr__( 'Tamil', 'blank-theme' ),
			'telugu'                => esc_attr__( 'Telugu', 'blank-theme' ),
			'thai'                  => esc_attr__( 'Thai', 'blank-theme' ),
			'serif'                 => _x( 'Serif', 'font style', 'blank-theme' ),
			'sans-serif'            => _x( 'Sans Serif', 'font style', 'blank-theme' ),
			'monospace'             => _x( 'Monospace', 'font style', 'blank-theme' ),
			'font-family'           => esc_attr__( 'Font Family', 'blank-theme' ),
			'font-size'             => esc_attr__( 'Font Size', 'blank-theme' ),
			'font-weight'           => esc_attr__( 'Font Weight', 'blank-theme' ),
			'line-height'           => esc_attr__( 'Line Height', 'blank-theme' ),
			'letter-spacing'        => esc_attr__( 'Letter Spacing', 'blank-theme' ),
			'top'                   => esc_attr__( 'Top', 'blank-theme' ),
			'bottom'                => esc_attr__( 'Bottom', 'blank-theme' ),
			'left'                  => esc_attr__( 'Left', 'blank-theme' ),
			'right'                 => esc_attr__( 'Right', 'blank-theme' ),
		);

		$config = apply_filters( 'kirki/config', array() );

		if ( isset( $config['i18n'] ) ) {
			$i18n = wp_parse_args( $config['i18n'], $i18n );
		}

		return $i18n;

	}

	/**
	 * Shortcut method to get the font registry.
	 */
	public static function fonts() {
		return self::get_instance()->font_registry;
	}

	/**
	 * Constructor is private, should only be called by get_instance()
	 */
	private function __construct() {
	}

	/**
	 * Return true if we are debugging Kirki.
	 */
	public static function kirki_debug() {
		return (bool) ( defined( 'KIRKI_DEBUG' ) && KIRKI_DEBUG );
	}

    /**
     * Take a path and return it clean
     *
     * @param string $path
	 * @return string
     */
    public static function clean_file_path( $path ) {
        $path = str_replace( '', '', str_replace( array( "\\", "\\\\" ), '/', $path ) );
        if ( '/' === $path[ strlen( $path ) - 1 ] ) {
            $path = rtrim( $path, '/' );
        }
        return $path;
    }

	/**
	 * Determine if we're on a parent theme
	 *
	 * @param $file string
	 * @return bool
	 */
	public static function is_parent_theme( $file ) {
		$file = self::clean_file_path( $file );
		$dir  = self::clean_file_path( get_template_directory() );
		$file = str_replace( '//', '/', $file );
		$dir  = str_replace( '//', '/', $dir );
		if ( false !== strpos( $file, $dir ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Determine if we're on a child theme.
	 *
	 * @param $file string
	 * @return bool
	 */
	public static function is_child_theme( $file ) {
		$file = self::clean_file_path( $file );
		$dir  = self::clean_file_path( get_stylesheet_directory() );
		$file = str_replace( '//', '/', $file );
		$dir  = str_replace( '//', '/', $dir );
		if ( false !== strpos( $file, $dir ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Determine if we're running as a plugin
	 */
	private static function is_plugin() {
		if ( false !== strpos( self::clean_file_path( __FILE__ ), self::clean_file_path( get_stylesheet_directory() ) ) ) {
			return false;
		}
		if ( false !== strpos( self::clean_file_path( __FILE__ ), self::clean_file_path( get_template_directory_uri() ) ) ) {
			return false;
		}
		if ( false !== strpos( self::clean_file_path( __FILE__ ), self::clean_file_path( WP_CONTENT_DIR . '/themes/' ) ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Determine if we're on a theme
	 *
	 * @param $file string
	 * @return bool
	 */
	public static function is_theme( $file ) {
		if ( true == self::is_child_theme( $file ) || true == self::is_parent_theme( $file ) ) {
			return true;
		}
		return false;
	}
}
