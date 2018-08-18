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
	 * Assets Class instance.
	 *
	 * @var Assets
	 */
	public $assets;

	/**
	 * Initiate the theme resources.
	 *
	 * @action after_setup_theme, 9
	 */
	public function init() {
		$this->setup_theme();

		$this->assets = new Assets();
	}

	/**
	 * Setup theme.
	 *
	 * @return void
	 */
	public function setup_theme() {

		load_theme_textdomain( 'blank-theme', BLANK_THEME_TEMP_DIR . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'jetpack-responsive-videos' );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) );

		add_theme_support( 'custom-background', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) );

		add_theme_support( 'custom-logo', array(
			'header-text' => array(
				'site-title', 'site-description'
			),
		) );

		add_editor_style( array( 'editor-style.css', blank_theme_main_font_url() ) );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'blank-theme' ),
		) );
	}

	/**
	 * Add read more link
	 *
	 * @filter excerpt_more
	 *
	 * @return string
	 */
	public function add_read_more_link() {
		global $post;

		return sprintf( '<a class="moretag" href="%s">%s</a>', get_permalink( $post->ID ), esc_html__( 'Read More', 'blank-theme' ) );
	}

}
