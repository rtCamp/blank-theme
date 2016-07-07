<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Blank Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blank-theme' ); ?></a>

	<header id="masthead" class="site-header row-container" role="banner">
		<div class="site-branding">
			<?php echo blank_theme_site_branding(); ?>
		</div><!-- .site-branding -->

		<a id="primary-nav-button" class="blank-theme-mobile-nav-button" href="#site-navigation"><?php esc_html_e( 'Mobile Menu' , 'blank-theme' ); ?></a>
		<nav id="site-navigation" class="blank-theme-main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'depth' => 3 ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content row">
