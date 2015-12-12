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

if( ! function_exists( 'blank_theme_primary_classes' ) )
{
	function blank_theme_primary_classes( $more_classes = false, $override_foundation_classes = false )
	{
		$sidebar_postion = get_theme_mod( 'blank_theme_sidebar_position' );

		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-8 medium-12 small-12 column';

		if( $sidebar_postion === 'left' ){
			$foundation_classes .= 	' blank-theme-right';
		}
		else if( $sidebar_postion === 'no_sidebar' ){
			$foundation_classes = 'large-12 medium-12 small-12 column';
		}

		echo apply_filters( 'blank_theme_primary_classes' , "blank-theme-primary {$foundation_classes} {$more_classes} clearfix" , $more_classes, $foundation_classes );
	}
}

/**
 * Adds Foundation classes to #primary seciton of all templates
 * @return string classes
 */

if( ! function_exists( 'blank_theme_secondary_classes' ) )
{
	function blank_theme_secondary_classes( $more_classes = false, $override_foundation_classes = false )
	{
		//Override will be useful in page-templates
		$sidebar_postion = get_theme_mod( 'blank_theme_sidebar_position' );
		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-4 medium-12 small-12 column';
		$foundation_classes .= $sidebar_postion == 'left' ? ' blank-theme-left' : false;

		echo apply_filters( 'blank_theme_secondary_classes' , "blank-theme-secondary widget-area {$foundation_classes} {$more_classes} clearfix" , $more_classes, $foundation_classes );
	}
}


if( ! function_exists( 'blank_theme_main_font_url' ) )
{
	/**
	 * Returns the main font url of the theme, we are returning it from a function to handle two things
	 * one is to handle the http problems and the other is so that we can also load it to post editor.
	 * @return string font url
	 */
	function blank_theme_main_font_url()
	{
		/**
		 * Use font url without http://, we do this because google font without https have
		 * problem loading on websites with https.
		 * @var font_url
		 */
		$font_url = 'fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700';

		return ( substr( site_url(), 0, 8 ) == 'https://') ? 'https://' . $font_url : 'http://' . $font_url;
	}
}

if( ! function_exists( 'blank_theme_copyright_text' ) )
{
	function blank_theme_copyright_text()
	{
		$theme_uri = 'http://underscore-me.com/';

		$default = sprintf( esc_html__( '%1$s by %2$s.', 'blank-theme' ), 'Blank Theme', '<a href="" rel="designer">Sayed Taqui</a>' );

		$copyright_text = get_theme_mod( 'blank_theme_copyright_text' , $default );

		return $copyright_text;
	}
}

if( ! function_exists( 'blank_theme_site_branding' ) )
{
	function blank_theme_site_branding()
	{
		$site_title   = get_bloginfo( 'name' );
		$site_logo    = get_theme_mod( 'blank_theme_logo' );
		$hide_tagline = get_theme_mod( 'blank_theme_hide_tagline' );
		$title_class  = $site_logo ? ' screen-reader-text' : false;
		$desc_class   = $hide_tagline ? ' screen-reader-text' : false;

		if( $site_logo ){
			printf( '<a class="logo-link" href="%s" rel="home"><img src="%s" alt="%s" ></a>' , esc_url( home_url( '/' ) )  , esc_url( $site_logo ), __( 'Logo' , 'blank-theme' ) );
		}

		if ( is_front_page() && is_home() ){ ?>
			<h1 class="site-title<?php echo $title_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h1>
		<?php } else { ?>
			<h2 class="site-title<?php echo $title_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h2>
		<?php }

		?>

		<p class="site-description<?php echo $desc_class; ?>"><?php bloginfo( 'description' ); ?></p>

		<?php
	}
}

if( ! function_exists( 'blank_theme_pagination' ) )
{
	function blank_theme_pagination()
	{
		echo "<nav class='blank-theme-pagination clearfix' >";
			echo paginate_links();
		echo "</nav>";
	}
}

if( ! function_exists( 'blank_theme_readmore_text' ) )
{
	function blank_theme_readmore_text()
	{
	  	global $post;
		return sprintf( '<a class="moretag" href="%s">%s</a>' , get_permalink($post->ID) , __( 'Read More' , 'blank-theme' ) );
	}
}

add_filter('excerpt_more', 'blank_theme_readmore_text');
