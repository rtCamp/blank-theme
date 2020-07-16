<?php
/**
 * Test_Assets class for assets of the theme..
 *
 * @author  Kiran Potphode <kiran.potphode@rtcamp.com>
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

use BLANK_THEME\Inc\Assets;
use WP_Error;

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
	}

	/**
	 * Function to test hooks setup.
	 *
	 * @covers ::setup_hooks
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function test_setup_hooks() {

		Utility::invoke_method( $this->instance, '__construct' );

		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_styles' ) ) );

	}

	/**
	 * Tests script registration.
	 *
	 * @covers ::register_scripts
	 * @covers ::register_script
	 */
	public function test_register_scripts() {

		$this->instance->register_scripts();

		$this->assertTrue( wp_script_is( 'blank-theme-main' ) );

		Utility::mock_wp_query(
			array(),
			array(
				'is_front_page' => true,
				'is_home'       => true,
			)
		);

		$this->instance->register_scripts();

		$this->assertTrue( wp_script_is( 'blank-theme-home' ) );

		Utility::mock_wp_query(
			array(),
			array(
				'is_single' => true,
			)
		);

		$this->instance->register_scripts();

		$this->assertTrue( wp_script_is( 'blank-theme-single' ) );
	}

	/**
	 * Tests styles registration.
	 *
	 * @covers ::register_styles
	 * @covers ::register_style
	 */
	public function test_register_styles() {

		$this->instance->register_styles();

		$this->assertTrue( wp_style_is( 'blank-theme-main' ) );

		Utility::mock_wp_query(
			array(),
			array(
				'is_front_page' => true,
				'is_home'       => true,
			)
		);

		$this->instance->register_styles();

		$this->assertTrue( wp_style_is( 'blank-theme-home' ) );

		Utility::mock_wp_query(
			array(),
			array(
				'is_single' => true,
			)
		);

		$this->instance->register_styles();

		$this->assertTrue( wp_style_is( 'blank-theme-single' ) );
	}

	/**
	 * Tests get_file_version function.
	 *
	 * @covers ::get_file_version
	 */
	public function test_get_file_version() {

		$this->assertEquals( '1.0' , $this->instance->get_file_version( 'non-existent.css', '1.0' ) );

		$this->assertFalse( $this->instance->get_file_version( 'non-existent.css', false ) );

		$file_path = sprintf( '%s/%s', BLANK_THEME_BUILD_DIR, 'css/main.css' );
		$expected  = filemtime( $file_path );
		$this->assertEquals( $expected, $this->instance->get_file_version( 'css/main.css', false ) );
	}

}
