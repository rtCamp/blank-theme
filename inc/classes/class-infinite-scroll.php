<?php
/**
 * Infinite scroll for the theme.
 *
 * @package blank-theme
 */

namespace Blank_Theme;

class Infinite_Scroll extends Base {

	/**
	 * Setup jetpack for infinite theme support.
	 *
	 * @action after_setup_theme
	 */
	public function setup_jetpack() {

		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => array( $this, 'render_callback' ),
			'footer'    => 'page',
		) );

	}

	/**
	 * Render callback for infinite scroll.
	 *
	 * @return void
	 */
	public function render_callback() {

		while ( have_posts() ) {

			the_post();

			if ( is_search() ) {

				get_template_part( 'template-parts/content', 'search' );

			} else {

				get_template_part( 'template-parts/content', get_post_format() );

			}

		}

	}
}
