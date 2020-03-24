<?php
/**
 * Test_Infinite_Scroll class for Infinite_Scroll class of the theme.
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

use BLANK_THEME\Inc\Infinite_Scroll;

/**
 * Class Test_Infinite_Scroll
 *
 * @coversDefaultClass \BLANK_THEME\Inc\Infinite_Scroll
 */
class Test_Infinite_Scroll extends \WP_UnitTestCase {
	/**
	 * This Assets data member will contain Assets class object.
	 *
	 * @var BLANK_THEME\Inc\Infinite_Scroll
	 */
	protected $instance = false;

	/**
	 * This function activate the theme.
	 *
	 * @return void
	 */
	public function setUp(): void {

		parent::setUp();
		switch_theme( 'blank-theme' );
		$this->instance = new Infinite_Scroll();
	}

	/**
	 * @covers ::setup_jetpack
	 */
	public function test_setup_jetpack() {
		$this->instance->setup_jetpack();

		$expected_data = get_theme_support( 'infinite-scroll' )[0];

		$this->assertArrayHasKey( 'container', $expected_data );
		$this->assertEquals( 'main', $expected_data['container'] );

		$this->assertArrayHasKey( 'render', $expected_data );

		$this->assertArrayHasKey( 'footer', $expected_data );
		$this->assertEquals( 'page', $expected_data['footer'] );
	}

	/**
	 * @covers ::render_callback
	 */
	public function test_render_callback() {

		$post_ids = $this->factory->post->create_many(
			10,
			array(
				'post_type' => 'post',
			)
		);

		Utility::mock_wp_query(
			array( 'post_type' => 'post' ),
			array()
		);
		$output = Utility::buffer_and_return( array( $this->instance, 'render_callback' ) );

		$this->assertNotEmpty( $output );
		$this->assertContains( '<article', $output );

		Utility::mock_wp_query(
			array(
				'post_type' => 'post',
			),
			array(
				'is_search' => true,
			)
		);

		$output = Utility::buffer_and_return( array( $this->instance, 'render_callback' ) );

		$this->assertNotEmpty( $output );
		$this->assertContains( '<article', $output );
	}

}
