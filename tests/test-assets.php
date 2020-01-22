<?php
/**
 * Class TemplateTagsTest
 *
 * @package Blank_Theme
 */
use BLANK_THEME\Inc;
use BLANK_THEME\Inc\Helpers;

require dirname(__DIR__).'/inc/classes/class-assets.php';

/**
 * Template Tags test case.
 */
class AssetsTest extends WP_UnitTestCase {

	protected $_instance = false;

	public function setUp() {
		parent::setUp();
		$this->_instance = Assets::get_instance();
	}

	public function tearDown() {
		parent::tearDown();
	}

	public function test_get_asset_paths() {
		$expected = '';
		$this->expectOutputString( $expected );
		echo '<pre>';
		var_dump($this->_instance->get_asset_paths());
		echo '</pre>';
	}

}
