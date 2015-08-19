<?php
/**
 *  Contains custom functions used for the theme
 *  @package blanktheme
 */

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
		$default = sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'blank-theme' ), 'blank-theme', '<a href="http://automattic.com/" rel="designer">Sayed Taqui</a>' );

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
