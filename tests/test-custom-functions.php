<?php
/**
 * Test_Widgets class for custom functions (helpers/custom-functions.php).
 *
 * @author  Kiran Potphode <kiran.potphode@rtcamp.com>
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

use Exception;

// Include the custom functions for the theme.
require_once './inc/helpers/custom-functions.php';

/**
 * Class Test_Customizer.
 */
class Test_Custom_Functions extends \WP_UnitTestCase {
	
	public function setUp() : void {
		parent::setUp();
		switch_theme( 'blank-theme' );
	}

	public function test_blank_theme_primary_classes() {

		do_action( 'after_setup_theme' );

		$sidebar_position   = get_theme_mod( 'blank_theme_sidebar_position' );
		$foundation_classes = 'large-8 medium-8 small-12 cell column';

		if ( 'left' === $sidebar_position ) {
			$foundation_classes .= ' large-order-2 medium-order-2 small-order-1 ';
		} elseif ( 'right' === $sidebar_position ) {
			$foundation_classes .= ' ';
		} elseif ( 'no_sidebar' === $sidebar_position ) {
			$foundation_classes = ' large-12 medium-12 small-12 cell column ';
		}

		$this->expectOutputString( esc_html( "blank-theme-primary {$foundation_classes} test-classes clearfix" ) );
		blank_theme_primary_classes( 'test-classes', $foundation_classes );
	}
	
	public function test_blank_theme_secondary_classes() {
		$sidebar_position    = get_theme_mod( 'blank_theme_sidebar_position' );
		$foundation_classes  = 'large-4 medium-4 small-12 cell column';
		$foundation_classes .= 'left' === $sidebar_position ? ' large-order-1 medium-order-1 small-order-2' : false;

		$this->expectOutputString( esc_html( "blank-theme-secondary widget-area {$foundation_classes} test-classes clearfix" ) );
		blank_theme_secondary_classes( 'test-classes', $foundation_classes );
	}
	
	public function test_blank_theme_get_font_url() {
		$this->expectOutputString( esc_url( get_template_directory_uri() . '/assets/fonts/test' ) );
		blank_theme_get_font_url( '/test' );
	}
	
	public function test_blank_theme_pagination() {
		$allowed_tags = [
			'span' => [
				'class' => [],
			],
			'a'    => [
				'class' => [],
				'href'  => [],
			],
		];

		$this->expectOutputString( sprintf( '<nav class="blank-theme-pagination clearfix">%s</nav>', wp_kses( paginate_links(), $allowed_tags ) ) );
		blank_theme_pagination();
	}
}
