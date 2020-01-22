<?php
/**
 * Class TemplateTagsTest
 *
 * @package Blank_Theme
 */

/**
 * Template Tags test case.
 */
class CustomFunctionsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
	}

	function test_blank_theme_primary_classes() {
		$expected = 'blank-theme-primary large-8 medium-8 small-12 cell column  clearfix';
		$this->expectOutputString($expected);
		blank_theme_primary_classes();
	}

	function test_blank_theme_secondary_classes() {
		$expected = 'blank-theme-secondary widget-area large-4 medium-4 small-12 cell column  clearfix';
		$this->expectOutputString($expected);
		blank_theme_secondary_classes();
	}

	function test_blank_theme_get_font_url() {
		$path = '';
		$expected = esc_url( get_template_directory_uri() . '/assets/fonts' . $path );
		$this->expectOutputString( $expected );
		blank_theme_get_font_url($path);
		get_option( 'blog_charset' );
	}

	function test_blank_theme_pagination() {
		$expected = '<nav class="blank-theme-pagination clearfix"></nav>';
		$this->expectOutputString($expected);
		blank_theme_pagination();
	}
}
