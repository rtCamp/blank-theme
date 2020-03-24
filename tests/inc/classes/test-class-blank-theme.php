<?php
/**
 * Test_Blank_Theme class for base theme class of the theme..
 *
 * @author  Kiran Potphode <kiran.potphode@rtcamp.com>
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

use Exception;
use BLANK_THEME\Inc\BLANK_THEME;

/**
 * Class Test_Blank_Theme
 *
 * @coversDefaultClass \BLANK_THEME\Inc\BLANK_THEME
 */
class Test_Blank_Theme extends \WP_UnitTestCase {
	/**
	 * This Assets data member will contain Assets class object.
	 *
	 * @var \BLANK_THEME\Inc\BLANK_THEME
	 */
	protected $instance = false;

	/**
	 * This function activate the theme.
	 *
	 * @return void
	 */
	public function setUp() : void {

		parent::setUp();
		switch_theme( 'blank-theme' );
		$this->instance  = BLANK_THEME::get_instance();
		$this->mock_post = $this->factory()->post->create_and_get();
		$GLOBALS['post'] = $this->mock_post;
		add_filter( 'is_active_sidebar', array( $this, 'deactivate_sidebar' ), 10, 2 );
	}

	public function tearDown() {
		unset( $GLOBALS['post'] );
	}

	/**
	 * Test constructor function.
	 *
	 * @covers ::__construct
	 * @covers ::_setup_hooks
	 */
	public function test_construct() {

		Utility::invoke_method( $this->instance, '__construct' );
		$this->assertInstanceOf( 'BLANK_THEME\Inc\BLANK_THEME', $this->instance );
		$hooks = array(
			array(
				'type'     => 'filter',
				'name'     => 'excerpt_more',
				'priority' => 10,
				'function' => 'add_read_more_link',
			),
			array(
				'type'     => 'filter',
				'name'     => 'body_class',
				'priority' => 10,
				'function' => 'filter_body_classes',
			),
			array(
				'type'     => 'action',
				'name'     => 'wp_head',
				'priority' => 10,
				'function' => 'add_pingback_link',
			),
			array(
				'type'     => 'action',
				'name'     => 'after_setup_theme',
				'priority' => 10,
				'function' => 'setup_theme',
			),
			array(
				'type'     => 'action',
				'name'     => 'init',
				'priority' => 10,
				'function' => 'add_title_tag_support',
			),
		);

		// Check if hooks loaded.
		foreach ( $hooks as $hook ) {

			$this->assertEquals(
				$hook['priority'],
				call_user_func(
					sprintf( 'has_%s', $hook['type'] ),
					$hook['name'],
					array(
						$this->instance,
						$hook['function'],
					)
				),
				sprintf( 'BLANK_THEME::__construct() failed to register %1$s "%2$s" to %3$s()', $hook['type'], $hook['name'], $hook['function'] )
			);
		}
		$this->assertEquals( 10, has_filter( 'excerpt_more', array( $this->instance, 'add_read_more_link' ) ) );
		$this->assertEquals( 10, has_filter( 'body_class', array( $this->instance, 'filter_body_classes' ) ) );
		$this->assertEquals( 10, has_action( 'wp_head', array( $this->instance, 'add_pingback_link' ) ) );
	}

	/**
	 * Test function setup theme
	 *
	 * @covers ::setup_theme
	 */
	public function test_setup_theme() {

		$this->instance->setup_theme();

		$this->assertTrue( get_theme_support( 'automatic-feed-links' ) );
		$this->assertTrue( get_theme_support( 'title-tag' ) );
		$this->assertTrue( get_theme_support( 'post-thumbnails' ) );
		$this->assertTrue( get_theme_support( 'customize-selective-refresh-widgets' ) );
		$this->assertTrue( get_theme_support( 'jetpack-responsive-videos' ) );
		$this->assertTrue( get_theme_support( 'wp-block-styles' ) );
		$this->assertTrue( get_theme_support( 'align-wide' ) );

		$this->assertTrue( is_array( get_theme_support( 'html5' ) ) );
		$this->assertTrue( is_array( get_theme_support( 'post-formats' ) ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-background' ) ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-logo' ) ) );

		$this->assertArrayHasKey( 'primary', get_registered_nav_menus(), 'Primary menu registered' );

	}

	/**
	 * Test add read more link.
	 *
	 * @covers ::add_read_more_link
	 */
	public function test_add_read_more_link() {
		global $post;

		$post_id = $this->factory()->post->create( array( 'post_title' => 'Test Post' ) );
		$post    = get_post( $post_id );

		$read_more_link = sprintf( '<a class="moretag" href="%s">%s</a>', get_permalink( $post->ID ), esc_html__( 'Read More', 'blank-theme' ) );

		$this->assertEquals( $read_more_link, $this->instance->add_read_more_link() );
	}

	/**
	 * Test function to add custom body classes.
	 *
	 * @covers ::filter_body_classes
	 */
	public function test_filter_body_classes() {
		// error_log( var_export( is_active_sidebar( 'sidebar-1' ), true ) );
		$this->assertContains( 'test-class', $this->instance->filter_body_classes( array( 'test-class' ) ) );
		$this->assertContains( 'hfeed', $this->instance->filter_body_classes( array( 'test-class' ) ) );
		$this->assertContains( 'no-sidebar', $this->instance->filter_body_classes( array( 'test-class' ) ) );
		Utility::mock_wp_query(
			array(),
			array(
				'is_singular' => true,
			)
		);

		$this->assertNotContains( 'hfeed', $this->instance->filter_body_classes( array( 'test-class' ) ) );
	}

	/**
	 * Test function to add pingback link.
	 *
	 * @covers ::add_pingback_link
	 */
	public function test_add_pingback_link() {

		add_filter( 'pings_open', '__return_true' );
		$expected = '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';

		Utility::mock_wp_query(
			array(),
			array(
				'is_singular' => true,
			)
		);
		$actual = Utility::buffer_and_return( array( $this->instance, 'add_pingback_link' ) );
		$this->assertEquals( $expected, $actual );
	}

	public function deactivate_sidebar( $is_active, $index ) {

		if ( 'sidebar-1' === $index ) {
			return false;
		}
		return $is_active;
	}
}
