<?php

if ( class_exists( 'blank-theme' ) ) {
	/**
	 * Add sections
	 */
	Kirki::add_section( 'checkbox', array(
		'title'          => esc_attr__( 'Checkbox Controls', 'blank-theme' ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'text', array(
		'title'          => esc_attr__( 'Text Controls', 'blank-theme' ),
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'color', array(
		'title'          => esc_attr__( 'Color & Color-Alpha Controls', 'blank-theme' ),
		'priority'       => 3,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'numeric', array(
		'title'          => esc_attr__( 'Numeric Controls', 'blank-theme' ),
		'priority'       => 4,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'radio', array(
		'title'          => esc_attr__( 'Radio Controls', 'blank-theme' ),
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'select', array(
		'title'          => esc_attr__( 'Select Controls', 'blank-theme' ),
		'priority'       => 6,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'composite', array(
		'title'          => esc_attr__( 'Composite Controls', 'blank-theme' ),
		'priority'       => 7,
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_section( 'custom', array(
		'title'          => esc_attr__( 'Custom Control', 'blank-theme' ),
		'priority'       => 4,
		'capability'     => 'edit_theme_options',
	) );

	/**
	 * Add the configuration.
	 * This way all the fields using the 'blank_theme' ID
	 * will inherit these options
	 */
	Kirki::add_config( 'blank_theme', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	/**
	 * Add fields
	 */
	Kirki::add_field( 'blank_theme', array(
		'type'        => 'checkbox',
		'settings'    => 'checkbox_demo',
		'label'       => esc_attr__( 'Checkbox demo', 'blank-theme' ),
		'description' => esc_attr__( 'This is a simple checkbox', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'checkbox',
		'default'     => true,
		'priority'    => 10,
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'switch',
		'settings'    => 'switch_demo',
		'label'       => esc_attr__( 'Switch demo', 'blank-theme' ),
		'description' => esc_attr__( 'This is a switch control. Internally it is a checkbox and you can also change the ON/OFF labels.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'checkbox',
		'default'     => true,
		'priority'    => 10,
		'required'    => array(
			array(
				'setting'  => 'checkbox_demo',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'toggle',
		'settings'    => 'toggle_demo',
		'label'       => esc_attr__( 'Toggle demo', 'blank-theme' ),
		'description' => esc_attr__( 'This is a toggle. it is basically identical to a switch, the only difference is that it does not have any labels and to save space it is inline with the label. Internally this is a checkbox.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'checkbox',
		'default'     => true,
		'priority'    => 10,
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'text',
		'settings'    => 'text_demo',
		'label'       => esc_attr__( 'Text Control', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'default'     => esc_attr__( 'This text is entered in the "text" control.', 'blank-theme' ),
		'section'     => 'text',
		'default'     => '',
		'priority'    => 10,
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'textarea',
		'settings'    => 'textarea_demo',
		'label'       => esc_attr__( 'Textarea Control', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'default'     => esc_attr__( 'This text is entered in the "textarea" control.', 'blank-theme' ),
		'section'     => 'text',
		'default'     => '',
		'priority'    => 10,
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'editor',
		'settings'    => 'editor_demo',
		'label'       => esc_attr__( 'Editor Control', 'blank-theme' ),
		'description' => esc_attr__( 'Editor Control Description', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'text',
		'default'     => esc_attr__( 'This text is entered in the "editor" control.', 'blank-theme' ),
		'priority'    => 10,
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'code',
		'settings'    => 'code_demo',
		'label'       => esc_attr__( 'Code Control', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'description' => esc_attr__( 'This is a simple code control. You can define the language you want as well as the theme. In this demo we are using a CSS editor with the monokai theme.', 'blank-theme' ),
		'section'     => 'text',
		'default'     => 'body { background: #fff; }',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'css',
			'theme'    => 'monokai',
			'height'   => 250,
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'color',
		'settings'    => 'color_demo',
		'label'       => esc_attr__( 'Color Control', 'blank-theme' ),
		'description' => esc_attr__( 'This uses the default WordPress-core color control.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'color',
		'default'     => '#81d742',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '.demo.color p',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.demo.color p',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'color-alpha',
		'settings'    => 'color_alpha_demo',
		'label'       => esc_attr__( 'Color-Alpha Control', 'blank-theme' ),
		'description' => esc_attr__( 'Similar to the default Color control but with a teist: This one allows you to also select an opacity for the color and saves the value as HEX or RGBA depending on the alpha channel\'s value.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'color',
		'default'     => '#333333',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '.demo.color',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.demo.color',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'custom',
		'settings'    => 'custom_demo',
		'label'       => esc_attr__( 'Custom Control', 'blank-theme' ),
		'description' => esc_attr__( 'This is the control description', 'blank-theme' ),
		'help'        => esc_attr__( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'blank-theme' ),
		'section'     => 'custom',
		'default'     => '<div style="padding: 30px;background-color: #333; color: #fff; border-radius: 50px;">You can enter custom markup in this control and use it however you want</div>',
		'priority'    => 10,
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'dimension',
		'settings'    => 'dimension_demo',
		'label'       => esc_attr__( 'Dimension Control', 'blank-theme' ),
		'description' => esc_attr__( 'In this example we are changing the width of the body', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'composite',
		'default'     => '980px',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => 'body',
				'property' => 'width',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'body',
				'property' => 'width',
				'function' => 'css',
			),
		),
		'choices' => array(
			'units' => array( '%', 'rem', 'vmax' )
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'multicheck',
		'settings'    => 'multicheck_demo',
		'label'       => esc_attr__( 'Multicheck control', 'blank-theme' ),
		'description' => esc_attr__( 'You can define choices for this control and it will save the selected values as an array.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'checkbox',
		'default'     => array( 'option-1', 'option-3' ),
		'priority'    => 10,
		'choices'     => array(
			'option-1' => esc_attr__( 'Option 1', 'blank-theme' ),
			'option-2' => esc_attr__( 'Option 2', 'blank-theme' ),
			'option-3' => esc_attr__( 'Option 3', 'blank-theme' ),
			'option-4' => esc_attr__( 'Option 4', 'blank-theme' ),
			'option-5' => esc_attr__( 'Option 5', 'blank-theme' ),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'sortable',
		'settings'    => 'sortable_demo',
		'label'       => esc_attr__( 'Sortable Control', 'blank-theme' ),
		'section'     => 'checkbox',
		'description' => esc_attr__( 'Similar to the "multicheck" control, you can define choices foir this control and the options will be saved as an array. The main difference between the multicheck control and this one is that this one also allows you to rearrange the order of the items.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'default'     => array( 'option-1', 'option-3' ),
		'priority'    => 10,
		'choices'     => array(
			'option-1' => esc_attr__( 'Option 1', 'blank-theme' ),
			'option-2' => esc_attr__( 'Option 2', 'blank-theme' ),
			'option-3' => esc_attr__( 'Option 3', 'blank-theme' ),
			'option-4' => esc_attr__( 'Option 4', 'blank-theme' ),
			'option-5' => esc_attr__( 'Option 5', 'blank-theme' ),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'number',
		'settings'    => 'number_demo',
		'label'       => esc_attr__( 'Number Control', 'blank-theme' ),
		'description' => esc_attr__( 'This is a simple num,ber control that allows you to select integer values.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'numeric',
		'default'     => '10',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '.number-demo-border-radius',
				'property' => 'border-radius',
				'units'    => 'px',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => '.number-demo-border-radius',
				'property' => 'border-radius',
				'units'    => 'px',
				'function' => 'css',
			),
		),
		'choices'      => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1,
		)
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'slider',
		'settings'    => 'slider_demo',
		'label'       => esc_attr__( 'Slider Control', 'blank-theme' ),
		'description' => esc_attr__( 'Similar to the number control. The main difference is that on this one you can define a min, max & step value thus allowing you to use decimal values instead of just integers.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'numeric',
		'default'     => '10',
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => '.slider-demo-border-radius',
				'property' => 'border-radius',
				'units'    => 'px',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => '.slider-demo-border-radius',
				'property' => 'border-radius',
				'units'    => 'px',
				'function' => 'css',
			),
		),
		'choices'      => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1,
		)
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'radio',
		'settings'    => 'radio_demo',
		'label'       => esc_attr__( 'Radio Control', 'blank-theme' ),
		'description' => esc_attr__( 'A simple radio-inputs control.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'radio',
		'default'     => 'red',
		'priority'    => 10,
		'choices'     => array(
			'red'   => esc_attr__( 'Red', 'blank-theme' ),
			'green' => esc_attr__( 'Green', 'blank-theme' ),
			'blue'  => esc_attr__( 'Blue', 'blank-theme' ),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'radio_buttonset_demo',
		'label'       => esc_attr__( 'Radio-Buttonset Control', 'blank-theme' ),
		'description' => esc_attr__( 'This is a radio control styled as inline buttons. You can use this if you have few options with short titles that will fit in a single line.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'radio',
		'default'     => 'green',
		'priority'    => 10,
		'choices'     => array(
			'red'   => esc_attr__( 'Red', 'blank-theme' ),
			'green' => esc_attr__( 'Green', 'blank-theme' ),
			'blue'  => esc_attr__( 'Blue', 'blank-theme' ),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'radio-image',
		'settings'    => 'radio_image_demo',
		'label'       => esc_attr__( 'Radio-Image Control', 'blank-theme' ),
		'description' => esc_attr__( 'This is a radio control that allows you to define an image for every option is the array of choices in the field. Useful if you want for example to select a layout. You can even use the images included in the Kirki plugin for that, in the /assets/images directory.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'radio',
		'default'     => 'left',
		'priority'    => 10,
		'choices'     => array(
			'left'   => admin_url() . '/images/align-left-2x.png',
			'center' => admin_url() . '/images/align-center-2x.png',
			'right'  => admin_url() . '/images/align-right-2x.png',
		),
	) );

	function kirki_demo_get_palettes() {
		return array(
			'light' => array(
				'#ECEFF1',
				'#FFF176',
				'#4DD0E1',
			),
			'dark' => array(
				'#37474F',
				'#F9A825',
				'#00ACC1',
			),
		);
	}
	Kirki::add_field( '', array(
		'type'        => 'palette',
		'settings'     => 'palette_demo',
		'label'       => esc_attr__( 'Palette Control', 'blank-theme' ),
		'description' => esc_attr__( 'This is basically a radio control. It allows you to define an array of colors that will be used in order to convey your message in a visually compelling way.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'radio',
		'default'     => 'light',
		'priority'    => 10,
		'choices'     => kirki_demo_get_palettes(),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'typography',
		'settings'    => 'typography_demo',
		'label'       => esc_attr__( 'Typography Control', 'blank-theme' ),
		'description' => esc_attr__( 'This is a composite typography control. It saves the data as an array, and you can define which of the controls you want shown.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'composite',
		'default'     => array(
			'font-style'     => array( 'bold', 'italic' ),
			'font-family'    => 'Roboto',
			'font-size'      => '14',
			'font-weight'    => '400',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
		),
		'priority'    => 10,
		'choices'     => array(
			'font-style'     => true,
			'font-family'    => true,
			'font-size'      => true,
			'font-weight'    => true,
			'line-height'    => true,
			'letter-spacing' => true,
			'units'          => array( 'px', 'rem' ),
		),
		'output' => array(
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'repeater',
		'label'       => esc_attr__( 'Repeater Control', 'blank-theme' ),
		'description' => esc_attr__( 'The "repeater" control allows you to create rows of data and you can define the fields that the rows will use. Valide field-types are: text, checkbox, radio, select, textarea. The data is saves as a multi-dimentional array.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'composite',
		'priority'    => 10,
		'settings'    => 'repeater_demo',
		'default'     => array(
			array(
				'link_text' => esc_attr__( 'Kirki Site', 'blank-theme' ),
				'link_url'  => 'https://kirki.org',
			),
			array(
				'link_text' => esc_attr__( 'Kirki Repository', 'blank-theme' ),
				'link_url'  => 'https://github.com/aristath/kirki',
			),
		),
		'fields' => array(
			'link_text' => array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Link Text', 'blank-theme' ),
				'description' => esc_attr__( 'This will be the label for your link', 'blank-theme' ),
				'default'     => '',
			),
			'link_url' => array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Link URL', 'blank-theme' ),
				'description' => esc_attr__( 'This will be the link URL', 'blank-theme' ),
				'default'     => '',
			),
		)
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'select',
		'settings'    => 'select_demo',
		'label'       => esc_attr__( 'Select Control', 'blank-theme' ),
		'description' => esc_attr__( 'A simple select (dropdown) control, allowing you to make a single option from a relatively large pool of options.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'select',
		'default'     => 'green',
		'priority'    => 10,
		'choices'     => array(
			''      => esc_attr__( 'Placeholder Text', 'blank-theme' ),
			'red'   => esc_attr__( 'Red', 'blank-theme' ),
			'green' => esc_attr__( 'Green', 'blank-theme' ),
			'blue'  => esc_attr__( 'Blue', 'blank-theme' ),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'select',
		'settings'    => 'select_multiple_demo',
		'label'       => esc_attr__( 'Select Control (multiple)', 'blank-theme' ),
		'description' => esc_attr__( 'A multi-select control, allowing you to select multiple items simultaneously as well as re-arrange them at will using a simple drag-n-drop interface. Data is saved as an array.', 'blank-theme' ),
		'help'        => esc_attr__( 'This is a tooltip', 'blank-theme' ),
		'section'     => 'select',
		'default'     => array( 'option-1' ),
		'priority'    => 10,
		'multiple'    => 3,
		'choices'     => array(
			'option-1' => esc_attr__( 'Option 1', 'blank-theme' ),
			'option-2' => esc_attr__( 'Option 2', 'blank-theme' ),
			'option-3' => esc_attr__( 'Option 3', 'blank-theme' ),
			'option-4' => esc_attr__( 'Option 4', 'blank-theme' ),
			'option-5' => esc_attr__( 'Option 5', 'blank-theme' ),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'preset',
		'settings'    => 'preset_demo',
		'label'       => esc_attr__( 'Preset control', 'blank-theme' ),
		'description' => esc_attr__( 'Bulk-changes the value of other controls.', 'blank-theme' ),
		'section'     => 'select',
		'default'     => '1',
		'priority'    => 10,
		'multiple'    => 3,
		'choices'     => array(
			'1' => array(
				'label'    => esc_attr__( 'Option 1', 'blank-theme' ),
				'settings' => array(
					'select_demo'             => 'red',
					'select_multiple_demo'    => array( 'option-1', 'option-2' ),
					'color_demo_preset'       => '#0088cc',
					'color_alpha_preset'      => 'rgba(237,226,23,0.58)'
				),
			),
			'2' => array(
				'label'    => esc_attr__( 'Option 2', 'blank-theme' ),
				'settings' => array(
					'select_demo'             => 'green',
					'select_multiple_demo'    => array( 'option-4', 'option-1' ),
					'color_demo_preset'       => '#333333',
					'color_alpha_preset'      => 'rgba(181,18,178,0.58)'
				),
			),
		),
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'color',
		'settings'    => 'color_demo_preset',
		'label'       => esc_attr__( 'Color Control', 'blank-theme' ),
		'section'     => 'select',
		'default'     => '#81d742',
		'priority'    => 10,
	) );

	Kirki::add_field( 'blank_theme', array(
		'type'        => 'color-alpha',
		'settings'    => 'color_alpha_preset',
		'label'       => esc_attr__( 'Color Alpha Control', 'blank-theme' ),
		'section'     => 'select',
		'default'     => '#ffffff',
		'priority'    => 10,
	) );

}
