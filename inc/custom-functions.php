<?php
/**
 *  Contains custom functions used for the theme
 *
 *  @package Blank Theme
 */

/**
 * Adds Foundation classes to #primary section of all templates
 * @return string classes
 */

if ( ! function_exists( 'blank_theme_primary_classes' ) ) {
	function blank_theme_primary_classes( $more_classes = false, $override_foundation_classes = false ) {
		$sidebar_postion = get_theme_mod( 'blank_theme_sidebar_position' );

		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-8 medium-8 small-12 column';

		if ( 'left' === $sidebar_postion ) {
			$foundation_classes .= ' blank-theme-right';
		} else if ( 'no_sidebar' === $sidebar_postion ) {
			$foundation_classes = 'large-12 medium-12 small-12 column';
		}

		echo esc_html( apply_filters( 'blank_theme_primary_classes' , "blank-theme-primary {$foundation_classes} {$more_classes} clearfix" , $more_classes, $foundation_classes ) );
	}
}

/**
 * Adds Foundation classes to #primary seciton of all templates
 * @return string classes
 */

if ( ! function_exists( 'blank_theme_secondary_classes' ) ) {
	function blank_theme_secondary_classes( $more_classes = false, $override_foundation_classes = false ) {
		//Override will be useful in page-templates
		$sidebar_postion = get_theme_mod( 'blank_theme_sidebar_position' );
		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-4 medium-4 small-12 column';
		$foundation_classes .= 'left' == $sidebar_postion ? ' blank-theme-left' : false;

		echo esc_html( apply_filters( 'blank_theme_secondary_classes' , "blank-theme-secondary widget-area {$foundation_classes} {$more_classes} clearfix" , $more_classes, $foundation_classes ) );
	}
}


if ( ! function_exists( 'blank_theme_main_font_url' ) ) {
	/**
	 * Returns the main font url of the theme, we are returning it from a function to handle two things
	 * one is to handle the http problems and the other is so that we can also load it to post editor.
	 * @return string font url
	 */
	function blank_theme_main_font_url() {
		/**
		 * Use font url without http://, we do this because google font without https have
		 * problem loading on websites with https.
		 * @var font_url
		 */
		$font_url = 'fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700';

		return ( substr( site_url(), 0, 8 ) == 'https://') ? 'https://' . $font_url : 'http://' . $font_url;
	}
}

if ( ! function_exists( 'blank_theme_copyright_text' ) ) {
	function blank_theme_copyright_text() {
		$theme_uri = 'https://rtcamp.com/';

		$default = sprintf( esc_html__( '%1$s by %2$s', 'blank-theme' ), 'Blank Theme', '<a href="" rel="designer">rtCamp</a>' );

		$copyright_text = get_theme_mod( 'blank_theme_copyright_text' , $default );

		return $copyright_text;
	}
}

if ( ! function_exists( 'blank_theme_site_branding' ) ) {
	function blank_theme_site_branding() {
		$site_title = $site_logo = '';

		if ( function_exists( 'the_custom_logo' ) ) {
			$site_logo = get_custom_logo();
		}

		$site_title   = get_bloginfo( 'name' );
		$hide_tagline = get_theme_mod( 'blank_theme_hide_tagline' );
		$title_class  = $site_logo ? ' screen-reader-text' : false;
		$desc_class   = $hide_tagline ? ' screen-reader-text' : false;

		$site_logo_args = array(
			'a' => array(
				'href'		=> array(),
				'class'		=> array(),
				'rel'		=> array(),
				'itemprop'	=> array(),
			),
			'img' => array(
				'width'		=> array(),
				'height'	=> array(),
				'src'		=> array(),
				'class'		=> array(),
				'alt'		=> array(),
				'itemprop'	=> array(),
			),
		);

		echo wp_kses( $site_logo, $site_logo_args );

		if ( is_front_page() && is_home() ) { ?>
			<h1 class="site-title<?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $site_title ); ?></a></h1>
		<?php } else { ?>
			<h2 class="site-title<?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( $site_title ); ?></a></h2>
		<?php }

		?>

		<p class="site-description<?php echo esc_attr( $desc_class ); ?>"><?php bloginfo( 'description' ); ?></p>

		<?php
	}
}

if ( ! function_exists( 'blank_theme_pagination' ) ) {
	function blank_theme_pagination() {
		echo '<nav class="blank-theme-pagination clearfix">';
		$pagination_args = array(
			'span' => array(
				'class'	=> array(),
			),
			'a' => array(
				'class'	=> array(),
				'href'	=> array(),
			),
		);
		echo wp_kses( paginate_links(), $pagination_args );
		echo '</nav>';
	}
}

/**
 * Created out of frustration to check isset each time getting value from array
 */
if ( ! function_exists( 'blank_theme_isset' ) ) {
	function blank_theme_isset( $array, $key1, $key2 = false, $key3 = false, $key4 = false ) {
		if ( $key4 ) {
			return isset( $array[ $key1 ][ $key2 ][ $key3 ][ $key4 ] ) ? $array[ $key1 ][ $key2 ][ $key3 ][ $key4 ] : false;
		}

		if ( $key3 ) {
			return isset( $array[ $key1 ][ $key2 ][ $key3 ] ) ? $array[ $key1 ][ $key2 ][ $key3 ] : false;
		}

		if ( $key2 ) {
			return isset( $array[ $key1 ][ $key2 ] ) ? $array[ $key1 ][ $key2 ] : false;
		}

		if ( $key1 ) {
			return isset( $array[ $key1 ] ) ? $array[ $key1 ] : false;
		}
	}
}


if ( ! function_exists( 'blank_theme_get_template_part' ) ) {

	/**
	 * Its an extension to WordPress get_template_part function.
	 * It can be used when you need to call a template and all pass variables to it. and they will be available in your template part
	 * @param  string $slug file slug like you use in get_template_part
	 * @param  array  $params pass an array of variables you want to use in array keys,
	 */
	function blank_theme_get_template_part( $slug, $params = array() ) {
		if ( ! empty( $params ) ) {
			foreach ( $params as $k => $param ) {
				set_query_var( $k, $param );
			}
		}
		get_template_part( $slug );
	}
}

if ( ! function_exists( 'db' ) ) {

	/**
	 * Function for Debugging
	 */
	function db( $val, $exit = null, $method = 'pre' ) {
		if ( isset( $_REQUEST['db'] ) && ! empty( $_REQUEST['db'] ) ) {

			if ( 'pre' == $method ) {
				echo '<pre>';
				print_r( $val );
				echo '</pre>';
			} else if ( $method ) {
				var_dump( $val );
			}

			if ( $exit ) {
				exit;
			}
		}
	}
}
