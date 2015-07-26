<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package blanktheme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer row" role="contentinfo">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ){ ?>
		<div class="rtp-footer-widgets-left large-12 column">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
		<?php } ?>
		<div class="site-info large-12 column">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'blank-theme' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'blank-theme' ), 'blank theme' ); ?></a>
			<span class="sep"> | </span>
			<?php echo blank_theme_copyright_text(); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
