<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Blank Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ){ ?>
		<div class="rtp-footer-widgets-left row">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
		<?php } ?>
		<div class="site-info row-container">
			<span class="blank-theme-copyright-text"><?php echo blank_theme_copyright_text(); ?></span>
			<span class="sep"> | </span>
			<a class="blank-theme-author-footer" href="<?php echo esc_url( 'https://rtcamp.com/' ); ?>" target="_blank"><?php esc_html_e( 'Blank Theme', 'blank-theme' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
