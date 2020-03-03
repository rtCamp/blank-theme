<?php
/**
 * Test_Customizer class for base theme class of the theme..
 *
 * @author  Kiran Potphode <kiran.potphode@rtcamp.com>
 *
 * @package Blank_Theme
 */

namespace BLANK_THEME\Tests;

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
	 * @covers ::_setup_hooks
	 */
	public function test_construct() {
		Utility::invoke_method( $this->instance, '__construct' );

		$this->assertInstanceOf( 'BLANK_THEME\Inc\Customizer', $this->instance );


		$hooks = [
			[
				'type'     => 'action',
				'name'     => 'customize_register',
				'priority' => 10,
				'function' => 'customize_register',
			],
			[
				'type'     => 'action',
				'name'     => 'customize_preview_init',
				'priority' => 10,
				'function' => 'customize_preview_init',
			],
		];

		// Check if hooks loaded.
		foreach ( $hooks as $hook ) {

			$this->assertEquals(
				$hook['priority'],
				call_user_func(
					sprintf( 'has_%s', $hook['type'] ),
					$hook['name'],
					[
						$this->instance,
						$hook['function'],
					]
				),
				sprintf( 'Customizer::__construct() failed to register %1$s "%2$s" to %3$s()', $hook['type'], $hook['name'], $hook['function'] )
			);
		}
	}

	/**
	 * Test customize partial blog name.
	 *
	 * @covers ::customize_partial_blog_name
	 */
	public function test_customize_partial_blog_name() {
		$expected = get_bloginfo( 'name' );

		$actual = Utility::buffer_and_return( [ $this->instance, 'customize_partial_blog_name' ] );
		$this->assertEquals( $expected, $actual );

	}

	/**
	 * Test customize partial blog decription.
	 *
	 * @covers ::customize_partial_blog_description
	 */
	public function test_partial_blog_description() {
		$expected = get_bloginfo( 'description' );

		$actual = Utility::buffer_and_return( [ $this->instance, 'customize_partial_blog_description' ] );
		$this->assertEquals( $expected, $actual );
	}

	/**
	 * Test customizer scripts.
	 *
	 * @covers ::enqueue_customizer_scripts
	 */
	public function test_enqueue_customizer_scripts() {
		$this->assertFalse( wp_script_is( 'blank-theme-customizer' ) );

		$this->instance->enqueue_customizer_scripts();

		$this->assertTrue( wp_script_is( 'blank-theme-main' ) );
	}

	public function test_customize_register() {

		wp_set_current_user(
			$this->factory->user->create( [ 'role' => 'administrator' ] )
		);

		$wp_customize = new \WP_Customize_Manager();

		$wp_customize->add_setting( 'blogname' , array(
			'default'   => 'Test',
			'transport' => 'refresh',
		) );


		do_action( 'customize_register', $wp_customize );

		$this->assertEquals( $wp_customize->get_setting( 'blogname' )->transport, 'postMessage' );
	}
}
