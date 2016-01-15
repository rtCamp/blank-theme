<?php


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

