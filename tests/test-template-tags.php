<?php
/**
 * Class TemplateTagsTest
 *
 * @package Blank_Theme
 */

/**
 * Template Tags test case.
 */
class TemplateTagsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
	}

	function test_blank_theme_posted_on() {
		$expected = '<span class="posted-on">Posted on <a href="" rel="bookmark"><time class="entry-date published updated" datetime=""></time></a></span>';
		$this->expectOutputString($expected);
		blank_theme_posted_on();
	}

	function test_blank_theme_posted_by() {
		$expected = '<span class="byline"> by <span class="author vcard"><a class="url fn n" href="http://example.org/?author=0"></a></span></span>';
		$this->expectOutputString($expected);
		blank_theme_posted_by();
	}

}
