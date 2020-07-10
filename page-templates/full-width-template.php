<?php
/**
 * Template Name: Full Width Template
 *
 * Used for showing full width template
 *
 * @package Blank-Theme
 */

get_header();
?>

<div id="primary">
	<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
