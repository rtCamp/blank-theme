<?php
/**
 * Test_Customizer class for base theme class of the theme..
 *
 * @author  Kiran Potphode <kiran.potphode@rtcamp.com>
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

use Exception;
use BLANK_THEME\Inc\Customizer;

/**
 * Class Test_Customizer
 *
 * @coversDefaultClass \Blank_Theme\Inc\Customizer
 */
class Test_Customizer extends \WP_UnitTestCase {
	/**
	 * This Assets data member will contain Assets class object.
	 *
	 * @var BLANK_THEME\Inc\Customizer
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
		$this->instance = Customizer::get_instance();
	}

	/**
	 * Test constructor function.
	 *
	 * @covers ::__construct
	 */
	public function test_construct() {
		$this->assertInstanceOf( 'BLANK_THEME\Inc\Customizer', $this->instance );
	}

	/**
	 * Function to test hooks setup.
	 *
	 * @covers ::_setup_hooks
	 */
	public function test_setup_hooks() {
		$this->assertEquals( 10, has_action( 'customize_register', array( $this->instance, 'customize_register' ) ) );
		$this->assertEquals( 10, has_action( 'customize_preview_init', array( $this->instance, 'customize_preview_init' ) ) );
	}

	/**
	 * Test customize partial blog name.
	 *
	 * @covers ::customize_partial_blog_name
	 */
	public function test_customize_partial_blog_name() {
		$bloginfo = get_bloginfo( 'name' );

		$this->expectOutputString( $bloginfo );
		$this->instance->customize_partial_blog_name();
	}

	/**
	 * Test customize partial blog decription.
	 *
	 * @covers ::customize_partial_blog_description
	 */
	public function test_partial_blog_description() {
		$blogdescription = get_bloginfo( 'description' );

		$this->expectOutputString( $blogdescription );
		$this->instance->customize_partial_blog_description();
	}

	/**
	 * Test customizer scripts.
	 *
	 * @covers ::enqueue_customizer_scripts
	 */
	public function test_enqueue_customizer_scripts() {
		$this->assertFalse( wp_script_is( 'blank-theme-customizer' ) );

		do_action( 'wp_enqueue_scripts' );

		$this->assertTrue( wp_script_is( 'blank-theme-main' ) );
	}
}
