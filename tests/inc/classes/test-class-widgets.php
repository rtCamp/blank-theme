<?php
/**
 * Test_Widgets class for Widgets class of the theme.
 *
 * @author  Kiran Potphode <kiran.potphode@rtcamp.com>
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

use BLANK_THEME\Inc\Widgets;

/**
 * Class Test_Customizer
 *
 * @coversDefaultClass \BLANK_THEME\Inc\Widgets
 */
class Test_Widgets extends \WP_UnitTestCase {
	/**
	 * This Assets data member will contain Assets class object.
	 *
	 * @var BLANK_THEME\Inc\Widgets
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
		$this->instance = Widgets::get_instance();
	}

	/**
	 * Tests class construct.
	 *
	 * @covers ::__construct
	 * @covers ::_setup_hooks
	 *
	 * @return void
	 */
	public function test_construct() {

		Utility::invoke_method( $this->instance, '__construct' );

		$this->assertInstanceOf( 'BLANK_THEME\Inc\Widgets', $this->instance );

		$this->assertEquals( 10, has_action( 'widgets_init', array( $this->instance, 'register_widgets' ) ) );

	}

	/**
	 * Tests `register_widgets` function.
	 *
	 * @covers ::register_widgets
	 * 
	 * @return void
	 */
	public function test_register_widgets() {

		$this->instance->register_widgets();

		$sidebars = wp_get_sidebars_widgets();

		$this->assertArrayHasKey( 'sidebar-1', $sidebars );
		$this->assertArrayHasKey( 'sidebar-2', $sidebars );

	}

}
