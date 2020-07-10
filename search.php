<?php
/**
 * The template for displaying search results pages.
 *
 * @package Blank-Theme
 */

get_header();
?>

<section id="primary">
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search phrase */
					printf( esc_html__( 'Search Results for: %s', 'blank-theme' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :

				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
	<?php blank_theme_pagination(); ?>
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
