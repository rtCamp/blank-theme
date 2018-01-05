<?php
/**
 * Theme Header Functions.
 *
 * @package Blank Theme
 */

if ( ! function_exists( 'blank_theme_header_style' ) ) :

	/**
	 * Styles the header image and text displayed on the blog
	 *
	 * @see blank_theme_custom_header_setup().
	 */
	function blank_theme_header_style() {
		$header_text_color = get_header_textcolor();

		// If no custom options for text are set, let's bail.
		// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
			<?php
		endif;
		?>
		</style>
		<?php
	}

endif; // blank_theme_header_style.
