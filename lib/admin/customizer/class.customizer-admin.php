<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since vanguard 1.0
 */

class BLANK_THEME_Customizer_Admin extends BLANK_THEME_Customizer {

  public static $section_priority = array( 2 => '2nd', 3 => '3rd', 4 => '4th', 5 => '5th' );

  public static $default_special_font = "Arizonia";

  public static $default_body_font = "Source Sans Pro";

  public static $theme_default_color = '#deb25e';

  public static $cat_array = array();

	public function __construct()
	{

    self::$cat_array = self::category_array();

		// Setup the Theme Customizer settings and controls...
		add_action( 'customize_register' , array( $this , 'register' ) );

		// Enqueue live preview javascript in Theme Customizer admin screen
		add_action( 'customize_preview_init' , array( $this , 'live_preview' ) );

    add_action( 'customize_controls_enqueue_scripts', array( $this , 'load_customizer_controls_scripts' )  );

    add_action( 'wp_ajax_blank_theme_load_variants_subsets' , array( $this, 'load_variants_subsets' ) );

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
    * @since vanguard 1.0
    */
   public static function register ( $wp_customize )
   {

      /************************** GENERAL ***************************/

      $wp_customize->add_panel( 'blank_theme_general_panel',
        array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'General', 'vanguard', 'blank-theme' ),
        ));

      $wp_customize->add_section( 'blank_theme_favicon_section',
         array(
            'title'       => __( 'Favicon', 'vanguard', 'blank-theme' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'description' => __('', 'vanguard', 'blank-theme'), //Descriptive tooltip
            'panel'       => 'blank_theme_general_panel'
        ));

      /*==============================
                  FAVICON
      ===============================*/

      $wp_customize->add_setting( 'blank_theme_favicon',
         array(
            'default'    => "",
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
         ));

      $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, 'blank_theme_favicon',
             array(
                'label'    => __( 'Choose Favicon', 'vanguard', 'blank-theme' ),
                'section'  => 'blank_theme_favicon_section',
                'settings' => 'blank_theme_favicon',
             )
      ));

      /*==============================
                  LOGO
      ===============================*/

      $wp_customize->add_section( 'blank_theme_logo_section',
         array(
            'title'       => __( 'Site Logo', 'vanguard', 'blank-theme' ),
            'priority'    => 10,
            'capability'  => 'edit_theme_options',
            'description' => __('', 'vanguard', 'blank-theme'), //Descriptive tooltip
            'panel'       => 'blank_theme_general_panel'
        ));

      $wp_customize->add_setting( 'blank_theme_logo',
         array(
            'default'    => "",
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
         ));

      $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, 'blank_theme_logo',
             array(
                'label'    => __( 'Choose Site Logo', 'vanguard', 'blank-theme' ),
                'section'  => 'blank_theme_logo_section',
                'settings' => 'blank_theme_logo',
             )
      ));

      /*==============================
            Footer Copyright Text
      ===============================*/

      $wp_customize->add_section( 'blank_theme_copyright_text_section',
         array(
            'title'       => __( 'Copyright Text', 'vanguard', 'blank-theme' ),
            'capability'  => 'edit_theme_options',
            'description' => __('Will override the footer copyright text', 'vanguard', 'blank-theme'), //Descriptive tooltip
            'panel'       => 'blank_theme_general_panel'
        ));


      //SPECIAL FONTS
      $wp_customize->add_setting( 'blank_theme_footer_copyright',
         array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
         ));

      $wp_customize->add_control(
              'blank_theme_footer_copyright',
             array(
                'label'    => __( 'Copyright Text', 'vanguard', 'blank-theme' ),
                'section'  => 'blank_theme_copyright_text_section',
                'settings' => 'blank_theme_footer_copyright',
                'type'     => 'text',
             )
      );

      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
      $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
      $wp_customize->remove_control('header_image');
      $wp_customize->remove_control('header_textcolor');

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
    * @since vanguard 1.0
    */
   public static function live_preview() {
      //To avoid caching during development
      wp_enqueue_script(
           'blank-theme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . BLANK_THEME_ADMIN_FOLDER_PATH . 'customizer/js/customizer-live-preview.js',
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '1.0', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );
   }

   public function load_customizer_controls_scripts()
   {
      wp_enqueue_script(
           'blank-theme-customizer-control-scripts', // Give the script a unique ID
           get_template_directory_uri() . BLANK_THEME_ADMIN_FOLDER_PATH . 'customizer/js/customizer-control.js',
           array(  'jquery' ), // Define dependencies
           '1.0', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );

   }

   public function load_variants_subsets()
   {
      $font_value = isset($_REQUEST['font_value']) ? $_REQUEST['font_value'] : false;

      $variants = blank_theme_get_google_fonts_variants( false, false, $font_value );
      $subsets = blank_theme_get_google_fonts_subsets( false, false, $font_value );

      echo json_encode( array( 'variants' => $variants, 'subsets' => $subsets ) );

      die();
   }

}

new BLANK_THEME_Customizer_Admin();
