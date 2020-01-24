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
		$this->instance = BLANK_THEME::get_instance();
	}

	/**
	 * Test constructor function.
	 *
	 * @covers ::__construct
	 */
	public function test_construct() {
		$this->assertInstanceOf( 'BLANK_THEME\Inc\BLANK_THEME', $this->instance );
	}

	/**
	 * Function to test hooks setup.
	 *
	 * @covers ::_setup_hooks
	 */
	public function test_setup_hooks() {
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

		do_action( 'after_setup_theme' );

		$this->assertTrue( get_theme_support( 'automatic-feed-links' ) );
		$this->assertTrue( get_theme_support( 'title-tag' ) );
		$this->assertTrue( get_theme_support( 'post-thumbnails' ) );
		$this->assertTrue( get_theme_support( 'customize-selective-refresh-widgets' ) );
		$this->assertTrue( get_theme_support( 'jetpack-responsive-videos' ) );
		$this->assertTrue( get_theme_support( 'wp-block-styles' ) );
		$this->assertTrue( get_theme_support( 'align-wide' ) );

		$this->assertIsArray( get_theme_support( 'html5' ) );
		$this->assertIsArray( get_theme_support( 'post-formats' ) );
		$this->assertIsArray( get_theme_support( 'custom-background' ) );
		$this->assertIsArray( get_theme_support( 'custom-logo' ) );

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
		$this->assertContains( 'test-class', $this->instance->filter_body_classes( array( 'test-class' ) ) );
	}

	/**
	 * Test function to add pingback link.
	 *
	 * @covers ::add_pingback_link
	 */
	public function test_add_pingback_link() {
		$expected = '';

		if ( is_singular() && pings_open() ) {
			$expected = '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
		}

		$this->expectOutputString( $expected );
		$this->instance->add_pingback_link();
	}
}
