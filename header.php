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
				$title_class = false;

				if ( get_theme_mod( 'custom_logo' ) ) {
					the_custom_logo();

					// If showing logo, hide the blog name.
					$title_class = 'screen-reader-text';
				}

				if ( is_front_page() && is_home() ) :

					?>
					<h1 class="site-title <?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php

				else :

					?>
					<h2 class="site-title <?php echo esc_attr( $title_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php

				endif;

				$description  = get_bloginfo( 'description', 'display' );
				$hide_tagline = get_theme_mod( 'blank_theme_hide_tagline' );
				$desc_class   = $hide_tagline ? 'screen-reader-text' : false;

				if ( $description || is_customize_preview() ) :

					?>
					<p class="site-description <?php echo esc_attr( $desc_class ); ?>"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php

				endif;
				?>
			</div><!-- .site-branding -->

			<a id="primary-nav-button" class="blank-theme-mobile-nav-button menu-toggle" href="#site-navigation"><?php esc_html_e( 'Mobile Menu', 'blank-theme' ); ?></a>

			<nav id="site-navigation" class="blank-theme-main-navigation auto cell column" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'blank-theme' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu menu',
						'depth'          => 3,
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div class="grid-container grid-container-padded">
		<div id="content" class="site-content row grid-x grid-margin-x">
