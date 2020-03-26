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
	 * Tests class construct.
	 *
	 * @covers ::__construct
	 * @covers ::_setup_hooks
	 *
	 * @return void
	 */
	public function test_construct() {
		Utility::invoke_method( $this->instance, '__construct' );

		$this->assertInstanceOf( 'BLANK_THEME\Inc\Customizer', $this->instance );

		$hooks = array(
			array(
				'type'     => 'action',
				'name'     => 'customize_register',
				'priority' => 10,
				'function' => 'customize_register',
			),
			array(
				'type'     => 'action',
				'name'     => 'customize_preview_init',
				'priority' => 10,
				'function' => 'customize_preview_init',
			),
		);

		// Check if hooks loaded.
		foreach ( $hooks as $hook ) {

			$this->assertEquals(
				$hook['priority'],
				call_user_func(
					sprintf( 'has_%s', $hook['type'] ),
					$hook['name'],
					array(
						$this->instance,
						$hook['function'],
					)
				),
				sprintf( 'Customizer::__construct() failed to register %1$s "%2$s" to %3$s()', $hook['type'], $hook['name'], $hook['function'] )
			);
		}
	}

	/**
	 * Tests customize partial blog name.
	 *
	 * @covers ::customize_partial_blog_name
	 *
	 * @return void
	 */
	public function test_customize_partial_blog_name() {
		$expected = get_bloginfo( 'name' );

		$actual = Utility::buffer_and_return( array( $this->instance, 'customize_partial_blog_name' ) );
		$this->assertEquals( $expected, $actual );

	}

	/**
	 * Tests customize partial blog description.
	 *
	 * @covers ::customize_partial_blog_description
	 *
	 * @return void
	 */
	public function test_partial_blog_description() {
		$expected = get_bloginfo( 'description' );

		$actual = Utility::buffer_and_return( array( $this->instance, 'customize_partial_blog_description' ) );
		$this->assertEquals( $expected, $actual );
	}

	/**
	 * Tests `customize_register` function.
	 *
	 * @covers ::customize_register
	 *
	 * @return void
	 */
	public function test_customize_register() {

		wp_set_current_user(
			$this->factory->user->create( array( 'role' => 'administrator' ) )
		);

		$wp_customize = new \WP_Customize_Manager();

		$wp_customize->add_setting(
			'blogname',
			array(
				'default'   => 'Test',
				'transport' => 'postName',
			)
		);

		$wp_customize->add_setting(
			'blogdescription',
			array(
				'default'   => 'Test',
				'transport' => 'postName',
			)
		);

		$wp_customize->add_setting(
			'header_textcolor',
			array(
				'default'   => 'Test',
				'transport' => 'postName',
			)
		);

		$this->instance->customize_register( $wp_customize );

		$this->assertEquals( $wp_customize->get_setting( 'blogname' )->transport, 'postMessage' );

		$this->assertEquals( $wp_customize->get_setting( 'blogdescription' )->transport, 'postMessage' );

		$this->assertEquals( $wp_customize->get_setting( 'header_textcolor' )->transport, 'postMessage' );

	}
}
