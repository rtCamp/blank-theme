<?php
/**
 * Class Test_Base_Blank_Theme
 *
 * @package Blank_Theme
 */

// Include the functions for the theme.
require_once './functions.php';

/**
 * Sample test case.
 */
class Test_Base_Blank_Theme extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		switch_theme( 'blank-theme' );
	}

	public function tearDown() {
		parent::tearDown();
	}

	public function test_jquery_is_loaded() {

		$this->assertFalse( wp_script_is( 'jquery' ) );

		do_action( 'wp_enqueue_scripts' );
		$this->assertTrue( wp_script_is( 'jquery' ) );

	} // end testjQueryIsLoaded

	public function test_active_theme() {


		$this->assertTrue( wp_get_theme() == 'blank-theme' );
	} // end testThemeInitialization

	public function test_inactive_theme() {

		$this->assertFalse( wp_get_theme() == 'Twenty Eleven' );

	} // end testInactiveTheme
}
