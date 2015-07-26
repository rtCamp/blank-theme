<?php
/**
 *  Contains custom functions used for the theme
 *  @package blanktheme
 */

if( ! function_exists( 'blank_theme_copyright_text' ) )
{
	function blank_theme_copyright_text()
	{
		$default = sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'blank-theme', 'blank-theme' ), 'blank-theme', '<a href="http://automattic.com/" rel="designer">Sayed Taqui</a>' );

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
		$logo_class   = $site_logo ? ' screen-reader-text' : false;
		$desc_class   = $hide_tagline ? ' screen-reader-text' : false;

		if( $site_logo ){
			printf( '<img src="%s" alt="%s" >' , esc_url( $site_logo ), __( 'Logo' , 'blank-theme' ) );
		}

		if ( is_front_page() && is_home() ){ ?>
			<h1 class="site-title<?php echo $logo_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h1>
		<?php } else { ?>
			<h2 class="site-title<?php echo $logo_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h2>
		<?php }

		?>

		<p class="site-description<?php echo $desc_class; ?>"><?php bloginfo( 'description' ); ?></p>

		<?php
	}
}