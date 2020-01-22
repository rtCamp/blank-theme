<?php
/**
 * Test_Assets class for assets of the theme..
 *
 * @author  Kiran Potphode <kiran.potphode@rtcamp.com>
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

use Exception;
use BLANK_THEME\Inc\Assets;

/**
 * Class Test_Assets
 *
 * @coversDefaultClass \BLANK_THEME\Inc\Assets
 */
class Test_Assets extends \WP_UnitTestCase {
	/**
	 * This Assets data member will contain Assets class object.
	 *
	 * @var BLANK_THEME\Inc\Assets
	 */
	protected $instance = false;

	/**
	 * This function activate the theme.
	 *
	 * @return void
	 */
	public function setUp() : void {

		parent::setUp();
		$this->instance = Assets::get_instance();
		switch_theme( 'blank-theme' );
		update_option( 'thread_comments', 1 );
		add_filter( 'comments_open', array( $this, 'open_comments' ) );
	}

	/**
	 * Filter to open comments for the post.
	 *
	 * @param bool $open Whether comments for the post are open.
	 *
	 * @return bool comments for the post are open or not.
	 */
	public function open_comments( $open ) {
		return true;
	}

	/**
	 * Function to test hooks setup.
	 */
	public function test_setup_hooks() {
		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_styles' ) ) );
	}

	/**
	 * Function to test scripts registration.
	 */
	public function test_register_scripts() {

		$this->assertFalse( wp_script_is( 'blank-theme-main' ) );
		$this->assertFalse( wp_style_is( 'blank-theme-main' ) );

		$this->assertFalse( wp_script_is( 'blank-theme-home' ) );
		$this->assertFalse( wp_style_is( 'blank-theme-home' ) );

		$this->assertFalse( wp_script_is( 'blank-theme-single' ) );
		$this->assertFalse( wp_style_is( 'blank-theme-single' ) );

		$this->assertFalse( wp_script_is( 'comment-reply' ) );
		$this->assertFalse( wp_style_is( 'comment-reply' ) );

		do_action( 'wp_enqueue_scripts' );

		$this->assertTrue( wp_script_is( 'blank-theme-main' ) );
		$this->assertTrue( wp_style_is( 'blank-theme-main' ) );
	}
}
