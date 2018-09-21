<?php
/**
 * Contains custom functions used for the theme
 *
 * @package Blank-Theme
 */

/**
 * Primary foundation classes.
 *
 * @param bool $more_classes                Provide extra classes.
 * @param bool $override_foundation_classes Override foundation classes.
 *
 * @return void
 */
function blank_theme_primary_classes( $more_classes = false, $override_foundation_classes = false ) {
	$sidebar_position = get_theme_mod( 'blank_theme_sidebar_position' );

	$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-8 medium-8 small-12 cell column';

	if ( 'left' === $sidebar_position ) {
		$foundation_classes .= ' large-order-2 medium-order-2 small-order-1 ';
	} elseif ( 'right' === $sidebar_position ) {
		$foundation_classes .= ' ';
	} elseif ( 'no_sidebar' === $sidebar_position ) {
		$foundation_classes = ' large-12 medium-12 small-12 cell column ';
	}

	echo esc_html( "blank-theme-primary {$foundation_classes} {$more_classes} clearfix" );
}

/**
 * Adds Foundation classes to #primary section of all templates.
 *
 * @param bool $more_classes                Provide more classes.
 * @param bool $override_foundation_classes Override foundation classes.
 *
 * @return void
 */
function blank_theme_secondary_classes( $more_classes = false, $override_foundation_classes = false ) {
	// Override will be useful in page-templates.
	$sidebar_position    = get_theme_mod( 'blank_theme_sidebar_position' );
	$foundation_classes  = $override_foundation_classes ? $override_foundation_classes : 'large-4 medium-4 small-12 cell column';
	$foundation_classes .= 'left' === $sidebar_position ? ' large-order-1 medium-order-1 small-order-2' : false;

	echo esc_html( "blank-theme-secondary widget-area {$foundation_classes} {$more_classes} clearfix" );
}


/**
 * Returns the main font url of the theme, we are returning it from a function to handle two things
 * one is to handle the http problems and the other is so that we can also load it to post editor.
 *
 * @return string font url
 */
function blank_theme_main_font_url() {

	/**
	 * Use font url without http://, we do this because google font without https have
	 * problem loading on websites with https.
	 *
	 * @var string
	 */
	$font_url = 'fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700';

	return ( 'https://' === substr( site_url(), 0, 8 ) ) ? 'https://' . $font_url : 'http://' . $font_url;
}

/**
 * Blank Theme Pagination.
 */
function blank_theme_pagination() {

	$allowed_tags = array(
		'span' => array(
			'class' => array(),
		),
		'a'    => array(
			'class' => array(),
			'href'  => array(),
		),
	);

	printf( '<nav class="blank-theme-pagination clearfix">%s</nav>', wp_kses( paginate_links(), $allowed_tags ) );
}

/**
 * Its an extension to WordPress get_template_part function.
 * It can be used when you need to call a template and all pass variables to it. and they will be available in your template part.
 *
 * @param  string $slug file slug like you use in get_template_part.
 * @param  array  $params pass an array of variables you want to use in array keys.
 *
 * @return void
 */
function blank_theme_get_template_part( $slug, $params = array() ) {
	if ( ! empty( $params ) ) {
		foreach ( $params as $k => $param ) {
			set_query_var( $k, $param );
		}
	}
	get_template_part( $slug );
}
