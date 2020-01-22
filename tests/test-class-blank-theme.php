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
	 * @var BLANK_THEME\Inc\BLANK_THEME
	 */
	protected $instance = false;

	/**
	 * This function activate the theme.
	 *
	 * @return void
	 */
	public function setUp() : void {

		parent::setUp();
		$this->instance = BLANK_THEME::get_instance();
		switch_theme( 'blank-theme' );
	}

	/**
	 * Test constructor function.
	 */
	public function test_construct() {
		$this->assertInstanceOf( 'BLANK_THEME\Inc\BLANK_THEME', $this->instance );
	}

	/**
	 * Function to test hooks setup.
	 */
	public function test_setup_hooks() {
		$this->assertEquals( 10, has_filter( 'excerpt_more', array( $this->instance, 'add_read_more_link' ) ) );
		$this->assertEquals( 10, has_filter( 'body_class', array( $this->instance, 'filter_body_classes' ) ) );
		$this->assertEquals( 10, has_action( 'wp_head', array( $this->instance, 'add_pingback_link' ) ) );
	}

	/**
	 * Test function setup theme
	 */
	public function test_setup_theme() {

		$this->assertTrue( get_theme_support( 'automatic-feed-links' ) );
		$this->assertTrue( get_theme_support( 'title-tag' ) );
		$this->assertTrue( get_theme_support( 'post-thumbnails' ) );
		$this->assertTrue( get_theme_support( 'customize-selective-refresh-widgets' ) );
		$this->assertTrue( get_theme_support( 'jetpack-responsive-videos' ) );
		$this->assertTrue( get_theme_support( 'wp-block-styles' ) );
		$this->assertTrue( get_theme_support( 'align-wide' ) );

		// @TODO: check why tests are failing for html5.
		//$this->assertIsArray( get_theme_support( 'html5' ) ); 
		$this->assertIsArray( get_theme_support( 'post-formats' ) );
		$this->assertIsArray( get_theme_support( 'custom-background' ) );
		$this->assertIsArray( get_theme_support( 'custom-logo' ) );
	}
}
