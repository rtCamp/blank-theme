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
		do_action( 'vanguard_customizer_header_output' );
		$favicon = get_theme_mod( 'blank_theme_favicon' );
		$custom_css = get_theme_mod( 'blank_theme_custom_css' );
		$google_analytics = get_theme_mod( 'blank_theme_google_analytics' );
		if( $favicon ) :
	   ?>
	   <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
	   <?php endif; ?>

	   <!--Customizer CSS-->
	   <style type="text/css"><?php self::custom_css(); ?></style>
	   <!--/Customizer CSS-->
	   <!--vanguard Custom CSS-->
	   <?php echo "<style type='text/css'>{$custom_css}</style>" ?>

	   <!--/vanguard Custom CSS-->

	   <?php

	   if( $google_analytics ){
	   		echo "<script>{$google_analytics}</script>";
	   }

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

		return;

		//Also change .blank-theme-cat-divider background color;

		self::generate_css( 'body',
						array(
							'background-color',
							'background-repeat',
							'background-attachment',
							'background-image',
							'font-family'
							  ),
						array(
							'background_color',
							'background_repeat',
							'background_attachment',
							'background_image',
							'blank_theme_body_font'
							),
						array( '#', '', '', '', '"' ),
						array('', '', '', '', '"'),
						array( false, false, false, false, self::$default_body_font )
						);

		self::generate_css( '.blank-theme-special-title',
									array('font-family', 'color'),
									array('blank_theme_special_font', 'blank_theme_special_font_color'),
									array('"', ''),
									array('"', false ),
									array( self::$default_special_font , 'deb25e' ) );
		self::generate_css( '.blank-theme-section-3', 'background-image', 'home_section_3_background', 'url(', ')' );
		self::generate_css( '.blank-theme-section-5', 'background-image', 'home_section_5_background', 'url(', ')' );

		do_action('vanguard_customizer_custom_css');

	}

}

new BLANK_THEME_Customizer_Front();