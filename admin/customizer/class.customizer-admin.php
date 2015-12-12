<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since blank-theme 1.0
 */

class BLANK_THEME_Customizer_Admin extends BLANK_THEME_Customizer {

	public function __construct()
	{
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
    * @since blank-theme 1.0
    */
   public static function register ( $wp_customize )
   {

      /*==============================
            Site title & Tagline
      ===============================*/

      //Logo
      $wp_customize->add_setting( 'blank_theme_logo',
         array(
            'default'           => "",
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
         ));

      $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, 'blank_theme_logo',
             array(
                'label'    => __( 'Choose Site Logo', 'blank-theme' ),
                'section'  => 'title_tagline',
                'settings' => 'blank_theme_logo',
                'description' => __( 'Remove logo to display site title.' , 'blank-theme' )
             )
      ));

      //Hide tagline
      $wp_customize->add_setting( 'blank_theme_hide_tagline', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'blank_theme_sanitize_checkboxes',
      ));

      $wp_customize->add_control(
          new WP_Customize_Control(
          $wp_customize, 'blank_theme_hide_tagline', array(
              'label'    => __( 'Hide Tagline', 'blank-theme' ),
              'section'  => 'title_tagline',
              'settings' => 'blank_theme_hide_tagline',
              'type'     => 'checkbox',
          ))
      );


      /************************** GENERAL ***************************/

      $wp_customize->add_panel( 'blank_theme_general_panel',
        array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'General', 'blank-theme' ),
        ));

      /*==============================
                SIDEBAR POSITIONS
      ===============================*/

      $wp_customize->add_section( 'blank_theme_sidebar_position_section',
         array(
            'title'       => __( 'Sidebar Position', 'blank-theme' ),
            'capability'  => 'edit_theme_options',
            'description' => __('', 'blank-theme'), //Descriptive tooltip
            'panel'       => 'blank_theme_general_panel'
        ));

      $wp_customize->add_setting( 'blank_theme_sidebar_position', array(
          'default' => 'right',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'blank_theme_sanitize_choices',
      ));

      $wp_customize->add_control(
          new WP_Customize_Control(
          $wp_customize, 'blank_theme_sidebar_position', array(
              'label'    => __( 'Sidebar Position', 'blank-theme' ),
              'section'  => 'blank_theme_sidebar_position_section',
              'settings' => 'blank_theme_sidebar_position',
              'type'     => 'radio',
              'choices'  => array( 'left' => __( 'Left' , 'blank-theme' ) , 'right' => __( 'Right' , 'blank-theme' )  )
          ))
      );

      /*==============================
            Footer Copyright Text
      ===============================*/

      $wp_customize->add_section( 'blank_theme_copyright_text_section',
         array(
            'title'       => __( 'Copyright Text', 'blank-theme' ),
            'capability'  => 'edit_theme_options',
            'description' => __('Will override the footer copyright text', 'blank-theme'), //Descriptive tooltip
            'panel'       => 'blank_theme_general_panel'
        ));


      //SPECIAL FONTS
      $wp_customize->add_setting( 'blank_theme_copyright_text',
         array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
         ));

      $wp_customize->add_control(
              'blank_theme_copyright_text',
             array(
                'label'    => __( 'Copyright Text', 'blank-theme' ),
                'section'  => 'blank_theme_copyright_text_section',
                'settings' => 'blank_theme_copyright_text',
                'type'     => 'text',
             )
      );

      /*==============================
                SLIDER
      ===============================*/

      $wp_customize->add_panel( 'blank_theme_pannel', array(
          'priority'       => 10,
          'capability'     => 'edit_theme_options',
          'title'          => __( 'Slider Options', 'blank-theme' ),
          'description'    => __( 'Add slider', 'blank-theme' ),
      ) );

      for ( $i=1; $i <= 8; $i++ )
      {
        $wp_customize->add_section( 'blank_theme_section_' . $i, array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'title'          => sprintf( __( 'Slide %s' , 'blank-theme' ), $i ),
            'description'    => __( 'Add slide', 'blank-theme' ),
            'panel'          => 'blank_theme_pannel',
        ) );

        $wp_customize->add_setting( 'blank_theme_slides['.$i.'][title]', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'blank_theme_slides['.$i.'][title]', array(
            'priority' => 10,
            'section'  => 'blank_theme_section_' . $i,
            'label'    => __( 'Title', 'blank-theme' ),
            'settings' => 'blank_theme_slides['.$i.'][title]',
        ) );

        $wp_customize->add_setting( 'blank_theme_slides['.$i.'][description]', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'blank_theme_slides['.$i.'][description]', array(
            'priority' => 10,
            'section'  => 'blank_theme_section_' . $i,
            'label'    => __('Description', 'blank-theme' ),
            'settings' => 'blank_theme_slides['.$i.'][description]',
        ) );

        $wp_customize->add_setting( 'blank_theme_slides['.$i.'][link]', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'blank_theme_slides['.$i.'][link]', array(
            'priority' => 10,
            'section'  => 'blank_theme_section_' . $i,
            'label'    => __( 'Link', 'blank-theme' ),
            'settings' => 'blank_theme_slides['.$i.'][link]',
        ) );

        $wp_customize->add_setting( 'blank_theme_slides['.$i.'][image]', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'blank_theme_slides['.$i.'][image]', array(
            'priority' => 10,
            'section'  => 'blank_theme_section_' . $i,
            'label'    => __( 'Image', 'blank-theme' ),
            'settings' => 'blank_theme_slides['.$i.'][image]',
        ) ) );

      }

      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
      $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
      $wp_customize->remove_control('header_image');
      //$wp_customize->remove_control('header_textcolor');

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
   public static function live_preview() {
      //To avoid caching during development
      wp_enqueue_script(
           'blank-theme-themecustomizer', // Give the script a unique ID
           BLANK_THEME_CUSTOMIZER_JS . '/customizer-live-preview.js',
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '1.0', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );
   }

   public function load_customizer_controls_scripts()
   {
      wp_enqueue_script(
           'blank-theme-customizer-control-scripts', // Give the script a unique ID
           BLANK_THEME_CUSTOMIZER_JS . '/customizer-control.js',
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
