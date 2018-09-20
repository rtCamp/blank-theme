<?php
/**
 * Theme widgets.
 *
 * @package blank-theme
 */

namespace Blank_Theme;

/**
 * Class Widgets
 */
class Widgets extends Base {

	/**
	 * Register widgets.
	 *
	 * @action widgets_init
	 */
	public function register_widgets() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'blank-theme' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'blank-theme' ),
				'id'            => 'sidebar-2',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

	}

}
