<?php

/**
 * IMPORTANT: Place this file code under customizer-settings.php to enable slider settings
 * And call slider.php file where you want to display slider
 */

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
