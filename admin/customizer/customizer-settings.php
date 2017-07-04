<?php

/* ==============================
  Site title & Tagline
  =============================== */

//Hide tagline
$wp_customize->add_setting( 'blank_theme_hide_tagline', array(
	'default'			 => '',
	'capability'		 => 'edit_theme_options',
	'sanitize_callback'	 => 'blank_theme_sanitize_checkboxes',
) );

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize, 'blank_theme_hide_tagline', array(
			'label'		 => esc_html__( 'Hide Tagline', 'blank-theme' ),
			'section'	 => 'title_tagline',
			'settings'	 => 'blank_theme_hide_tagline',
			'type'		 => 'checkbox',
		)
	)
);

/* * ************************ GENERAL ************************** */

$wp_customize->add_panel( 'blank_theme_general_panel', array(
	'priority'		 => 10,
	'capability'	 => 'edit_theme_options',
	'theme_supports' => '',
	'title'			 => esc_html__( 'General', 'blank-theme' ),
) );

/* ==============================
  SIDEBAR POSITIONS
  =============================== */

$wp_customize->add_section( 'blank_theme_sidebar_position_section', array(
	'title'			 => esc_html__( 'Sidebar Position', 'blank-theme' ),
	'capability'	 => 'edit_theme_options',
	'description'	 => '', //Descriptive tooltip
	'panel'			 => 'blank_theme_general_panel',
) );

$wp_customize->add_setting( 'blank_theme_sidebar_position', array(
	'default'			 => 'right',
	'capability'		 => 'edit_theme_options',
	'sanitize_callback'	 => 'blank_theme_sanitize_choices',
) );

$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize, 'blank_theme_sidebar_position', array(
			'label'		 => esc_html__( 'Sidebar Position', 'blank-theme' ),
			'section'	 => 'blank_theme_sidebar_position_section',
			'settings'	 => 'blank_theme_sidebar_position',
			'type'		 => 'radio',
			'choices'	 => array(
				'left'       => esc_html__( 'Left', 'blank-theme' ),
				'right'      => esc_html__( 'Right', 'blank-theme' ),
				'no_sidebar' => esc_html__( 'No Sidebar', 'blank-theme' ),
			),
		)
	)
);

/* ==============================
  Footer Copyright Text
  =============================== */

$wp_customize->add_section( 'blank_theme_copyright_text_section', array(
	'title'			 => esc_html__( 'Copyright Text', 'blank-theme' ),
	'capability'	 => 'edit_theme_options',
	'description'	 => esc_html__( 'Will override the footer copyright text', 'blank-theme' ), //Descriptive tooltip
	'panel'			 => 'blank_theme_general_panel',
) );


//SPECIAL FONTS
$wp_customize->add_setting( 'blank_theme_copyright_text', array(
	'default'			 => '',
	'capability'		 => 'edit_theme_options',
	'sanitize_callback'	 => 'sanitize_text_field',
) );

$wp_customize->add_control(
	'blank_theme_copyright_text', array(
		'label'		 => esc_html__( 'Copyright Text', 'blank-theme' ),
		'section'	 => 'blank_theme_copyright_text_section',
		'settings'	 => 'blank_theme_copyright_text',
		'type'		 => 'text',
	)
);

//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
$wp_customize->remove_control( 'header_image' );
// $wp_customize->remove_control('header_textcolor');
