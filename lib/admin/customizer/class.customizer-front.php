<?php

/**
 * Handles frontend
 */

class BLANK_THEME_Customizer_Front extends BLANK_THEME_Customizer_Admin
{

	public function __construct()
	{
		// Output custom CSS to live site
		add_action( 'wp_head' , array( $this , 'header_output' ) );
		add_action( 'wp_enqueue_scripts' , array( $this, 'enqueue_font' ) );
	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 */
	public function header_output() {
		do_action( 'blank_theme_customizer_header_output' );
		$favicon = get_theme_mod( 'blank_theme_favicon' );

	   if( $favicon ) { ?>
	   <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
	   <?php } ?>

	   <!--Customizer CSS-->
	   <style type="text/css"><?php self::custom_css(); ?></style>
	   <!--/Customizer CSS-->

	   <?php
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