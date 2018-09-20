<?php
/**
 * Customizer.
 *
 * @package blank-theme
 */

namespace Blank_Theme;

class Customizer extends Base {

	/**
	 * Customize register.
	 *
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @action customize_register
	 */
	public function customize_register( \WP_Customize_Manager $wp_customize ) {

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {

			$wp_customize->selective_refresh->add_partial(
				'blogname', array(
					'selector'        => '.site-title a',
					'render_callback' => array( $this, 'customize_partial_blog_name' ),
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription', array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'customize_partial_blog_description' ),
				)
			);

		}

	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_name() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function customize_partial_blog_description() {
		bloginfo( 'description' );
	}

	/**
	 * Enqueue customizer scripts.
	 *
	 * @action customize_preview_init
	 */
	public function enqueue_customizer_scripts() {
		wp_enqueue_script( 'blank-theme-customizer', Assets::asset_path( 'customizer.js' ), array( 'customize-preview' ), BLANK_THEME_VERSION, true );
	}

}
