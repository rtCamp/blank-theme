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

/**
 * Creates breadcrum if yoast bredcrumb does not exist
 * Also ads support for yoast breadcrubs
 */
if ( ! function_exists( 'blank_theme_breadcrumb' ) ) {
	function blank_theme_breadcrumb() {
		echo '<nav class="blank-theme-breacrumbs" >';
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			return;
		}

		echo '<ul class="blank-theme-breacrumbs-list" >';

		if ( ! is_home() ) {
			printf( '<li><a href="%s">%s</a></li>', esc_url( home_url() ), esc_html__( 'Home' , 'blank-theme' ) );

			if ( is_category() || is_single() ) {
				echo '<li>';

				the_category( ' </li><li> ' );

				if ( is_single() ) {
					the_title( '</li><li>', '</li>' );
				}
			} elseif ( is_page() ) {
				the_title( '<li>' , '</li>' );
			}
		} elseif ( is_tag() ) {
			single_tag_title();
		} elseif ( is_author() ) {
			printf( '<li>%s</li>' , esc_html__( 'Author Archive', 'blank-theme' ) );
		} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
			printf( '<li>%s</li>' , esc_html__( 'Blog Archive', 'blank-theme' ) );
		} elseif ( is_search() ) {
			printf( '<li>%s</li>' , esc_html__( 'Search Archive', 'blank-theme' ) );
		}

		echo '</ul>';
		echo '</nav>';

	}
}

/**
 * Creates font resizer
 */
if ( ! function_exists( 'blank_theme_font_resizer' ) ) {
	function blank_theme_font_resizer() {

		?>
			<div class="blank-theme-font-resizer">
				<a href="#" class="blank-theme-minus" data-type="minus" title="<?php esc_attr_e( 'Decrease Font Size' , 'blank-theme' ); ?>">[A-]</a>
				<a href="#" class="blank-theme-plus" data-type="plus" title="<?php esc_attr_e( 'Increase Font Size' , 'blank-theme' ); ?>">[A+]</a>
			</div>
		<?php
	}
}

/**
 * Creates Author Profile
 */
if ( ! function_exists( 'blank_theme_author_profile' ) ) {
	function blank_theme_author_profile() {

		if ( ! get_theme_mod( 'blank_theme_post_author' , true ) ) { return; }
		?>
		<div class="blank-theme-author-profile clearfix" rel="info" >
			<figure class="blank-theme-ap-avatar">
				<?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?>
			</figure>
			<div class="blank-theme-ap-info">
				<h3 class="blank-theme-ap-title"><?php esc_html_e( 'About ', 'blank-theme' ); the_author_posts_link(); ?></h3>
				<p class="blank-theme-ap-description"><?php the_author_meta( 'description' ); ?></p>
				<span class="blank-theme-ap-viewall">
					<?php esc_html_e( 'View all posts by ', 'blank-theme' ) . the_author_posts_link(); ?><span class="blank-theme-ap-icon blank-theme-icon-right-pointer"></span>
				</span>
			</div>
		</div>
		<?php
	}
}

/**
 * Creates post thumbnail navigation which can be used below posts
 */
if ( ! function_exists( 'blank_theme_post_thumbnail_navigation' ) ) {
	function blank_theme_post_thumbnail_navigation() {

		$prev_post = get_previous_post( true );
		$next_post = get_next_post( true );

		echo "<nav class='blank-theme-post-navigation row'>";

		if ( ! empty( $prev_post ) ) :  ?>

			<div class="blank-theme-prev-post large-5 medium-5 small-6 column">
				<?php
				$link = get_permalink( $prev_post->ID );
				$title = get_the_title( $prev_post->ID );
				$previous = sprintf( '<span class="blank-theme-nav-link"><span class="blank-theme-pn-icon blank-theme-icon-left-nav"></span> %s</span>' , esc_html__( ' Previous' , 'blank-theme' ) );
				$thumbnail_class = has_post_thumbnail( $prev_post->ID ) ? 'blank-theme-pn-has-thumb' : false;
				printf( "<a class='blank-theme-thumb-link %s' href='%s'>%s %s</a>", $thumbnail_class , $link, get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ) , $previous );
				printf( "<h4 class='blank-theme-pn-title' ><a href='%s'>%s</a></h4>" , $link, $title );
				?>
			</div>

		<?php endif;

		if ( ! empty( $next_post ) ) :  ?>

			<div class="blank-theme-next-post large-5 medium-5 small-6 column">
				<?php
				$link = get_permalink( $next_post->ID );
				$title = get_the_title( $next_post->ID );
				$next = sprintf( '<span class="blank-theme-nav-link">%s <span class="blank-theme-pn-icon blank-theme-icon-right-nav"></span></span>' , esc_html__( ' Next' , 'blank-theme' ) );
				$thumbnail_class = has_post_thumbnail( $next_post->ID ) ? 'blank-theme-pn-has-thumb' : false;
				printf( "<a class='blank-theme-thumb-link %s' href='%s'>%s %s</a>", $thumbnail_class , $link, get_the_post_thumbnail( $next_post->ID, 'thumbnail' ) , $next );
				printf( "<h4 class='blank-theme-pn-title'><a href='%s'>%s</a></h4>" , $link, $title );
				?>
			</div>

		<?php endif;

		echo '</nav>';

	}
}

/**
 * Ads back to top functionality
 */
if ( ! function_exists( 'blank_theme_add_back_to_top' ) ) {
	function blank_theme_add_back_to_top() {

		if ( get_theme_mod( 'blank_theme_back_to_top' , true ) ) {
			echo '<div class="blank-theme-back-to-top" id="blank-theme-back-to-top"></div>'; }
	}
}
add_action( 'wp_footer', 'blank_theme_add_back_to_top' );

/**
 * Changes the read more text
 */
if ( ! function_exists( 'blank_theme_readmore_text' ) ) {
	function blank_theme_readmore_text() {

		global $post;
		return sprintf( '<a class="moretag" href="%s">%s</a>' , get_permalink( $post->ID ) , __( 'Read More' , 'blank-theme' ) );
	}
}

add_filter( 'excerpt_more', 'blank_theme_readmore_text' );


/**
 * Default length of excerpt is 55 words in WordPress
 * Changes the excerpt length
 */
if ( ! function_exists( 'blank_theme_change_excerpt_length' ) ) {
	function blank_theme_change_excerpt_length( $length ) {

		$excerpt_length = intval( get_theme_mod( 'blank_theme_excerpt_length' ) );

		if ( $excerpt_length && $excerpt_length > 29 ) {
			return $excerpt_length;
		} else {
			return $length;
		}
	}
}

add_filter( 'excerpt_length', 'blank_theme_change_excerpt_length', 999 );

/**
 * Adds no js class in html
 */
function blank_theme_javascript_detection_class( $output ) {
	return $output . ' class="no-js"';
}
add_filter( 'language_attributes', 'blank_theme_javascript_detection_class' );

/**
 * Adds no js script
 */
function blank_theme_javascript_detection() {
	if ( has_filter( 'language_attributes', 'blank_theme_javascript_detection_class' ) ) {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}
}
add_action( 'wp_head', 'blank_theme_javascript_detection', 0 );

