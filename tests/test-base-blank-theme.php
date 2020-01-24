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

	/**
	 * Setup theme for test.
	 */
	public function setUp() : void {
		parent::setUp();
		switch_theme( 'blank-theme' );
	}

	/**
	 * Test if jQuery is loaded.
	 */
	public function test_jquery_is_loaded() {

		$this->assertFalse( wp_script_is( 'jquery' ) );

		do_action( 'wp_enqueue_scripts' );
		$this->assertTrue( wp_script_is( 'jquery' ) );

	} // end testjQueryIsLoaded

	/**
	 * Test if theme is active.
	 */
	public function test_active_theme() {
		$this->assertTrue( wp_get_theme()->get( 'Name' ) === 'blank-theme' );
	} // end testThemeInitialization

	/**
	 * Test random bundled theme is inactive.
	 */
	public function test_inactive_theme() {
		$this->assertFalse( wp_get_theme()->get( 'Name' ) === 'twentytwenty' );
	} // end testInactiveTheme
}
