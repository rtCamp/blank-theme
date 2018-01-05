<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Blank Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blank_theme_body_classes( $classes ) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
		if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', blank_theme_get_server_var( 'HTTP_USER_AGENT' ), $browser_version ) ) {
			$classes[] = 'ie' . $browser_version[1];
		}
	} else {
		$classes[] = 'unknown';
	}
	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}

	if ( strpos( blank_theme_get_server_var( 'HTTP_USER_AGENT' ), 'Mobile' ) !== false ) {
		$classes[] = 'mobile';
	}

	if ( strpos( blank_theme_get_server_var( 'HTTP_USER_AGENT' ), 'Android' ) !== false ) {
		$classes[] = 'android';
	}

	if ( strpos( blank_theme_get_server_var( 'HTTP_USER_AGENT' ), 'Opera Mini' ) !== false ) {
		$classes[] = 'opera-mini';
	}

	if ( strpos( blank_theme_get_server_var( 'HTTP_USER_AGENT' ), 'BlackBerry' ) !== false ) {
		$classes[] = 'blackberry';
	}

	if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && stristr( blank_theme_get_server_var( 'HTTP_USER_AGENT' ), 'mac' ) ) {
		$classes[] = 'osx';
	} elseif ( isset( $_SERVER['HTTP_USER_AGENT'] ) && stristr( blank_theme_get_server_var( 'HTTP_USER_AGENT' ), 'linux' ) ) {
		$classes[] = 'linux';
	} elseif ( isset( $_SERVER['HTTP_USER_AGENT'] ) && stristr( blank_theme_get_server_var( 'HTTP_USER_AGENT' ), 'windows' ) ) {
		$classes[] = 'windows';
	}
	if ( ! is_multi_author() ) {
		$classes[] = 'blank-theme-single-author';
	}
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}
	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'blank-theme-list-view';
	}
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	return $classes;
}

add_filter( 'body_class', 'blank_theme_body_classes' );

if ( ! function_exists( 'blank_theme_breadcrumb' ) ) {

	/**
	 * Creates breadcrum if yoast bredcrumb does not exist
	 * Also ads support for yoast breadcrubs
	 */
	function blank_theme_breadcrumb() {
		echo '<nav class="blank-theme-breacrumbs" >';

		if ( function_exists( 'yoast_breadcrumb' ) ) {

			yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
			return;

		}

		echo '<ul class="blank-theme-breacrumbs-list" >';

		if ( ! is_home() ) {

			printf( '<li><a href="%s">%s</a></li>', esc_url( home_url() ), esc_html__( 'Home', 'blank-theme' ) );

			if ( is_category() || is_single() ) {
				echo '<li>';

				the_category( ' </li><li> ' );

				if ( is_single() ) {
					the_title( '</li><li>', '</li>' );
				}
			} elseif ( is_page() ) {
				the_title( '<li>', '</li>' );
			}
		} elseif ( is_tag() ) {
			single_tag_title();
		} elseif ( is_author() ) {
			printf( '<li>%s</li>', esc_html__( 'Author Archive', 'blank-theme' ) );
		} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
			printf( '<li>%s</li>', esc_html__( 'Blog Archive', 'blank-theme' ) );
		} elseif ( is_search() ) {
			printf( '<li>%s</li>', esc_html__( 'Search Archive', 'blank-theme' ) );
		}

		echo '</ul>';
		echo '</nav>';

	}
}

if ( ! function_exists( 'blank_theme_add_back_to_top' ) ) {

	/**
	 * Ads back to top functionality.
	 */
	function blank_theme_add_back_to_top() {

		if ( get_theme_mod( 'blank_theme_back_to_top', true ) ) {
			echo '<div class="blank-theme-back-to-top" id="blank-theme-back-to-top"></div>'; }
	}
}

add_action( 'wp_footer', 'blank_theme_add_back_to_top' );

if ( ! function_exists( 'blank_theme_readmore_text' ) ) {

	/**
	 * Changes the read more text.
	 */
	function blank_theme_readmore_text() {

		global $post;
		return sprintf( '<a class="moretag" href="%s">%s</a>', get_permalink( $post->ID ), __( 'Read More', 'blank-theme' ) );
	}
}

add_filter( 'excerpt_more', 'blank_theme_readmore_text' );

if ( ! function_exists( 'blank_theme_change_excerpt_length' ) ) {

	/**
	 * Default length of excerpt is 55 words in WordPress.
	 * Changes the excerpt length.
	 *
	 * @param int $length Excerpt length.
	 *
	 * @return int Excerpt Length.
	 */
	function blank_theme_change_excerpt_length( $length ) {
		$length = 55;
		return $length;
	}
}

add_filter( 'excerpt_length', 'blank_theme_change_excerpt_length', 999 );

/**
 * Adds no js class in html.
 *
 * @param string $output Add class attribute to HTML tag.
 *
 * @return string
 */
function blank_theme_javascript_detection_class( $output ) {
	return $output . ' class="no-js"';
}

add_filter( 'language_attributes', 'blank_theme_javascript_detection_class' );

/**
 * Adds no js script.
 */
function blank_theme_javascript_detection() {
	if ( has_filter( 'language_attributes', 'blank_theme_javascript_detection_class' ) ) {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}
}

add_action( 'wp_head', 'blank_theme_javascript_detection', 0 );

if ( ! function_exists( 'blank_theme_get_sidebar' ) ) {

	/**
	 * Check if sidebar is disable from customizer setting.
	 * If sidebar is disable then remove it sitewide.
	 */
	function blank_theme_get_sidebar() {
		$sidebar_postion = get_theme_mod( 'blank_theme_sidebar_position' );
		if ( 'no_sidebar' !== $sidebar_postion ) {
			get_sidebar();
		}
	}
}
