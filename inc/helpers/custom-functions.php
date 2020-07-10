<?php
/**
 * Contains custom functions used for the theme
 *
 * @package Blank-Theme
 */

/**
 * An extension to get_template_part function to allow variables to be passed to the template.
 *
 * @param  string $slug file slug like you use in get_template_part without php extension.
 * @param  array  $variables pass an array of variables you want to use in array keys.
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
