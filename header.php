<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Blank-Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blank-theme' ); ?></a>

	<header id="masthead" class="site-header grid-container grid-container-padded" role="banner">
		<div class="row grid-x grid-margin-x">

			<div class="site-branding shrink cell column">
				<?php
					if ( get_theme_mod( 'custom_logo' ) ) {
						the_custom_logo();
						blank_theme_site_title( 'screen-reader-text' );
					} else {
						blank_theme_site_title();
					}

					blank_theme_site_description();
				?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="blank-theme-main-navigation auto cell column" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'blank-theme' ); ?>">
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu menu',
						'depth'          => 3,
					]
				);
				?>
			</nav><!-- #site-navigation -->

		</div>
	</header><!-- #masthead -->

	<div class="grid-container grid-container-padded">
		<div id="content" class="site-content row grid-x grid-margin-x">
