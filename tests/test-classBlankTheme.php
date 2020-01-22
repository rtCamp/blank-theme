<?php
/**
 * Class SampleTest
 *
 * @package Blank_Theme
 */

use BLANK_THEME;
use BLANK_THEME\Inc\Traits\Singleton;

/**
 * Sample test case.
 */
class BlankTheme extends WP_UnitTestCase {
	protected $_instance = false;
	/**
	 * A single example test.
	 */
	public function test_sample() {
		// Replace this with some actual testing code.
		$this->assertTrue( true );
		$this->_instance = BLANK_THEME ::get_instance();
	}
}
