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
 * Get font url.
 *
 * @param string $path Font path after fonts folder.
 *
 * @return void
 */
function blank_theme_get_font_url( $path ) {
	echo esc_url( get_template_directory_uri() . '/assets/fonts' . $path );
}

/**
 * Blank Theme Pagination.
 */
function blank_theme_pagination() {

	$allowed_tags = [
		'span' => [
			'class' => [],
		],
		'a'    => [
			'class' => [],
			'href'  => [],
		],
	];

	printf( '<nav class="blank-theme-pagination clearfix">%s</nav>', wp_kses( paginate_links(), $allowed_tags ) );
}

/**
 * An extension to get_template_part function to allow variables to be passed to the template.
 *
 * @param  string $slug file slug like you use in get_template_part without php extension.
 * @param  array  $variables pass an array of variables you want to use in array keys.
 *
 * @codeCoverageIgnore Ignoring becuase not able to mock output for locate_template
 *
 * @return void
 */
function blank_theme_get_template_part( $slug, $variables = [] ) {
	$template         = sprintf( '%s.php', $slug );
	$located_template = locate_template( $template, false, false );

	if ( '' === $located_template ) {
		return;
	}

	if ( ! empty( $variables ) && is_array( $variables ) ) {
		extract( $variables, EXTR_SKIP ); // @codingStandardsIgnoreLine - Used as an exception as there is no better alternative.
	}

	include $located_template;
}
