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
		add_filter( 'comments_open', '__return_true' );
	}

	/**
	 * Function to test hooks setup.
	 *
	 * @covers ::_setup_hooks
	 * @covers ::__construct
	 */
	public function test_setup_hooks() {

		Utility::invoke_method( $this->instance, '__construct' );

		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_styles' ) ) );

	}

	/**
	 * Function to test scripts registration.
	 *
	 * @covers ::register_scripts
	 * @covers ::register_styles
	 */
	public function test_register_scripts() {

		do_action( 'wp_enqueue_scripts' );

		Utility::mock_wp_query(
			[],
			[
				'is_singular' => true,
			]
		);

		$this->assertTrue( wp_script_is( 'blank-theme-main' ) );
		$this->assertTrue( wp_style_is( 'blank-theme-main' ) );
		$this->assertTrue( wp_script_is( 'comment-reply' ) );
	}

	/**
	 * Function to test scripts registration.
	 *
	 * @covers ::register_scripts
	 * @covers ::register_styles
	 */
	public function test_register_scripts_is_home() {

		Utility::mock_wp_query(
			[],
			[
				'is_home' => true,
			]
		);
		do_action( 'wp_enqueue_scripts' );

		$this->assertTrue( wp_script_is( 'blank-theme-home' ) );
		$this->assertTrue( wp_style_is( 'blank-theme-home' ) );
	}

	/**
	 * Function to test scripts registration.
	 *
	 * @covers ::register_scripts
	 * @covers ::register_styles
	 */
	public function test_register_scripts_is_single() {

		Utility::mock_wp_query(
			[],
			[
				'is_single' => true,
			]
		);
		do_action( 'wp_enqueue_scripts' );

		$this->assertTrue( wp_script_is( 'blank-theme-single' ) );
		$this->assertTrue( wp_style_is( 'blank-theme-single' ) );
	}

	/**
	 * @covers ::get_asset_file_path
	 */
	public function test_get_asset_file_path() {
		$asset_path = [
			'test' => 'test1',
		];

		Utility::set_and_get_property( $this->instance, 'asset_paths', $asset_path );

		$expected_path = untrailingslashit( get_template_directory() ) . '/assets/build/test1';
		$this->assertEquals( $expected_path, $this->instance->get_asset_file_path( 'test' ) );
	}

	/**
	 * @covers ::get_asset_file_uri
	 */
	public function test_get_asset_file_uri() {

		$asset_path = [
			'test' => 'test1',
		];

		Utility::set_and_get_property( $this->instance, 'asset_paths', $asset_path );

		$expected_path = untrailingslashit( get_template_directory_uri() ) . '/assets/build/test1';
		$this->assertEquals( $expected_path, $this->instance->get_asset_file_uri( 'test' ) );
	}
}
