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
	 *
	 * @return void
	 */
	public function test_setup_hooks() {

		Utility::invoke_method( $this->instance, '__construct' );

		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'register_styles' ) ) );

	}

	/**
	 * Tests `get_asset_file_path` function.
	 *
	 * @covers ::get_asset_file_path
	 *
	 * @return void
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
	 * Tests `get_asset_file_uri` function.
	 *
	 * @covers ::get_asset_file_uri
	 *
	 * @return void
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
	 * Tests `get_asset_paths` function.
	 *
	 * @covers ::get_asset_paths
	 *
	 * @return void
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

	/**
	 * Helper function to mock http response.
	 *
	 * @param array $mocked_response An array of mocked response data.
	 *
	 * @return void
	 */
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
