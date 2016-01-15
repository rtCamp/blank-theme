<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since blank-theme 1.0
 */

if( ! class_exists( 'BLANK_THEME_Customizer' ) )
{
  class BLANK_THEME_Customizer {

  	public function __construct()
  	{
  		// Setup the Theme Customizer settings and controls...
  		add_action( 'customize_register' , array( $this , 'register' ) );

  		// Enqueue live preview javascript in Theme Customizer admin screen
  		add_action( 'customize_preview_init' , array( $this , 'live_preview' ) );

      add_action( 'customize_controls_enqueue_scripts', array( $this , 'load_customizer_controls_scripts' )  );

  	}

     /**
      * This hooks into 'customize_register' (available as of WP 3.4) and allows
      * you to add new sections and controls to the Theme Customize screen.
      *
      * Note: To enable instant preview, we have to actually write a bit of custom
      * javascript. See live_preview() for more.
      *
      * @see add_action('customize_register',$func)
      * @param \WP_Customize_Manager $wp_customize
      * @since blank-theme 1.0
      */
     public static function register ( $wp_customize )
     {
        $file_path = BLANK_THEME_CUSTOMIZER_DIR . '/customizer-settings.php';

        if( file_exists( $file_path ) ) include_once $file_path;
     }

     /**
      * This outputs the javascript needed to automate the live settings preview.
      * Also keep in mind that this function isn't necessary unless your settings
      * are using 'transport'=>'postMessage' instead of the default 'transport'
      * => 'refresh'
      *
      * Used by hook: 'customize_preview_init'
      *
      * @see add_action('customize_preview_init',$func)
      * @since blank-theme 1.0
      */
     public static function live_preview()
     {
        wp_enqueue_script( 'blank-theme-themecustomizer',
             BLANK_THEME_CUSTOMIZER_JS . '/customizer-live-preview.js',
             array(  'jquery', 'customize-preview' ),
             '1.0',
             true
        );
     }

     public function load_customizer_controls_scripts()
     {
        wp_enqueue_script(
             'blank-theme-customizer-control-scripts',
             BLANK_THEME_CUSTOMIZER_JS . '/customizer-control.js',
             array(  'jquery' ),
             '1.0',
             true
        );

     }

  }
}

new BLANK_THEME_Customizer();
