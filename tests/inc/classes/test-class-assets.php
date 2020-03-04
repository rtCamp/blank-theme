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
		update_option( 'thread_comments', 1 );
		add_filter( 'comments_open', '__return_true' );
		$this->mock_post = $this->factory()->post->create_and_get();
		$GLOBALS['post'] = $this->mock_post;
	}

	public function tearDown() {
		unset( $GLOBALS['post'] );
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
		$this->assertTrue( wp_script_is( 'blank-theme-main' ) );
		$this->assertTrue( wp_style_is( 'blank-theme-main' ) );
	}

	/**
	 * Function to test scripts registration.
	 *
	 * @covers ::register_scripts
	 * @covers ::register_styles
	 */
	public function test_register_scripts_is_home() {
		$old_wp_query = $GLOBALS['wp_query'];
		Utility::mock_wp_query(
			array(),
			array(
				'is_home' => true,
			)
		);
		do_action( 'wp_enqueue_scripts' );

		$this->assertTrue( wp_script_is( 'blank-theme-home' ) );
		$this->assertTrue( wp_style_is( 'blank-theme-home' ) );
		$GLOBALS['wp_query'] = $old_wp_query;
	}

	/**
	 * Function to test scripts registration.
	 *
	 * @covers ::register_scripts
	 * @covers ::register_styles
	 */
	public function test_register_scripts_is_single() {
		$old_wp_query = $GLOBALS['wp_query'];
		Utility::mock_wp_query(
			array(),
			array(
				'is_single' => true,
			)
		);
		do_action( 'wp_enqueue_scripts' );

		$this->assertTrue( wp_script_is( 'blank-theme-single' ) );
		$this->assertTrue( wp_style_is( 'blank-theme-single' ) );
		$GLOBALS['wp_query'] = $old_wp_query;
	}

	/**
	 * @covers ::get_asset_file_path
	 */
	public function test_get_asset_file_path() {
		$asset_path = array(
			'test' => 'test1',
		);

		Utility::set_and_get_property( $this->instance, 'asset_paths', $asset_path );

		$expected_path = untrailingslashit( get_template_directory() ) . '/assets/build/test1';
		$this->assertEquals( $expected_path, $this->instance->get_asset_file_path( 'test' ) );
	}

	/**
	 * @covers ::get_asset_file_uri
	 */
	public function test_get_asset_file_uri() {

		$asset_path = array(
			'test' => 'test1',
		);

		Utility::set_and_get_property( $this->instance, 'asset_paths', $asset_path );

		$expected_path = untrailingslashit( get_template_directory_uri() ) . '/assets/build/test1';
		$this->assertEquals( $expected_path, $this->instance->get_asset_file_uri( 'test' ) );
	}

	/**
	 * @covers ::get_asset_paths
	 */
	public function test_get_asset_paths() {
		$http_response = array(
			'body' => wp_json_encode(
				array(
					'test1' => 'Test 1',
					'test2' => 'Test 2',
				)
			),
		);

		$this->mock_http_response( $http_response );

		$expected_data = array(
			'test1' => 'Test 1',
			'test2' => 'Test 2',
		);

		$this->assertEquals( $expected_data, $this->instance->get_asset_paths() );

		$http_response = new \WP_Error();

		$this->mock_http_response( $http_response );

		$this->assertFalse( $this->instance->get_asset_paths() );
	}

	public function mock_http_response( $mocked_response ) {
		add_filter(
			'pre_http_request',
			function( $response, $args, $url ) use ( $mocked_response ) {
				return $mocked_response;
			},
			10,
			3
		);
	}
}
