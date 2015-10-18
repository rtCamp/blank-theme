<?php

/**
 * Handles frontend
 */

class BLANK_THEME_Customizer_Front extends BLANK_THEME_Customizer_Admin
{

	public function __construct()
	{
		// Output custom CSS to live site
		add_action( 'wp_enqueue_scripts' , array( $this, 'enqueue_font' ) );
	}

	public function enqueue_font()
	{
		$special_font_url = blank_theme_library_get_google_font_uri( 'blank_theme_special_font', 'Arizonia' , 'blank_theme_special_font_variant' , 'blank_theme_special_font_subset' );
		$body_font_url    = blank_theme_library_get_google_font_uri( 'blank_theme_body_font', 'Source Sans Pro', 'blank_theme_body_font_variant', 'blank_theme_body_font_subset' );

		if( $special_font_url ) wp_enqueue_style( 'blank_theme_special_font' , $special_font_url );
		if( $body_font_url ) wp_enqueue_style( 'blank_theme_body_font' , $body_font_url );
	}

	/**
	 * Generates all css
	 * @return css output
	 */
	public static function custom_css()
	{
		//Backgroud image and background color is handled by wordpress

		do_action('blank_theme_customizer_custom_css');
	}

}

new BLANK_THEME_Customizer_Front();