<?php
/**
 * Bootstraps the Theme.
 *
 * @package blank-theme
 */

namespace Blank_Theme;

/**
 * Main plugin bootstrap file.
 */
class Blank_Theme extends Base {

	/**
	 * Assets class instance.
	 *
	 * @var Assets
	 */
	public $assets;

	/**
	 * Customizer class instance.
	 *
	 * @var Customizer
	 */
	public $customizer;

	/**
	 * Widgets
	 *
	 * @var Widgets
	 */
	public $widgets;

	/**
	 * Initiate the theme resources.
	 *
	 * @action after_setup_theme, 9
	 */
	public function init() {
		$this->setup_theme();

		$this->assets     = new Assets();
		$this->customizer = new Customizer();
		$this->widgets    = new Widgets();
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

		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		add_theme_support(
			'custom-background', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		);

		add_theme_support(
			'custom-logo', array(
				'header-text' => array(
					'site-title',
					'site-description',
				),
			)
		);

		add_editor_style( array( 'editor-style.css', blank_theme_main_font_url() ) );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'blank-theme' ),
			)
		);
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

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @filter body_class
	 * @return array
	 */
	public function filter_body_classes( $classes ) {

		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}

	/**
	 * Add a ping back url auto-discovery header for single posts, pages, or attachments.
	 *
	 * @action wp_head
	 *
	 * @return void
	 */
	public function add_pingback_link() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}

}
