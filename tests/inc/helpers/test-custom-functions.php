<?php
/**
 * Test cases for helper functions.
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

/**
 * Custom functions test cases
 */
class Test_Custom_functions extends \WP_UnitTestCase {

	/**
	 * This function activate the theme.
	 *
	 * @return void
	 */
	public function setUp() : void {

		parent::setUp();

		switch_theme( 'blank-theme' );

		$this->mock_post = $this->factory()->post->create_and_get();
		$GLOBALS['post'] = $this->mock_post;
	}

	/**
	 * Reset global post after every test case.
	 *
	 * @return void
	 */
	public function tearDown() {
		unset( $GLOBALS['post'] );
	}

	/**
	 * Tests `blank_theme_primary_classes` function.
	 *
	 * @covers blank_theme_primary_classes()
	 *
	 * @return void
	 */
	public function test_blank_theme_primary_classes() {

		set_theme_mod( 'blank_theme_sidebar_position', 'left' );
		$expected = 'blank-theme-primary large-8 medium-8 small-12 cell column large-order-2 medium-order-2 small-order-1  test clearfix';
		$output   = Utility::buffer_and_return( 'blank_theme_primary_classes', array( 'test' ) );
		$this->assertEquals( $expected, $output );

		set_theme_mod( 'blank_theme_sidebar_position', 'right' );
		$expected = 'blank-theme-primary large-8 medium-8 small-12 cell column  test clearfix';
		$output   = Utility::buffer_and_return( 'blank_theme_primary_classes', array( 'test' ) );
		$this->assertEquals( $expected, $output );

		set_theme_mod( 'blank_theme_sidebar_position', 'no_sidebar' );
		$expected = 'blank-theme-primary  large-12 medium-12 small-12 cell column  test clearfix';
		$output   = Utility::buffer_and_return( 'blank_theme_primary_classes', array( 'test' ) );
		$this->assertEquals( $expected, $output );

		set_theme_mod( 'blank_theme_sidebar_position', false );
	}

	/**
	 * Tests `blank_theme_secondary_classes` function.
	 *
	 * @covers blank_theme_secondary_classes()
	 *
	 * @return void
	 */
	public function test_blank_theme_secondary_classes() {

		$expected = 'blank-theme-secondary widget-area large-4 medium-4 small-12 cell column test clearfix';
		$output   = Utility::buffer_and_return( 'blank_theme_secondary_classes', array( 'test' ) );
		$this->assertEquals( $expected, $output );

		set_theme_mod( 'blank_theme_sidebar_position', 'left' );
		$expected = 'blank-theme-secondary widget-area large-4 medium-4 small-12 cell column large-order-1 medium-order-1 small-order-2 test clearfix';
		$output   = Utility::buffer_and_return( 'blank_theme_secondary_classes', array( 'test' ) );
		$this->assertEquals( $expected, $output );
	}

	/**
	 * Tests `blank_theme_get_font_url` function.
	 *
	 * @covers blank_theme_get_font_url()
	 *
	 * @return void
	 */
	public function test_blank_theme_get_font_url() {
		$expected = esc_url( get_template_directory_uri() . '/assets/fonts/test/path' );
		$output = Utility::buffer_and_return( 'blank_theme_get_font_url', array( '/test/path' ) );
		$this->assertEquals( $expected, $output );
	}

	/**
	 * Tests `blank_theme_pagination()` function.
	 * 
	 * @covers blank_theme_pagination()
	 *
	 * @return void
	 */
	public function test_blank_theme_pagination() {

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

		$output = Utility::buffer_and_return( 'blank_theme_pagination' );
		$this->assertContains( 'nav', $output );
		$this->assertContains( 'page-numbers', $output );
	}

}
