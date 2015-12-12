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

	<footer id="colophon" class="site-footer row" role="contentinfo">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ){ ?>
		<div class="rtp-footer-widgets-left large-12 column">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
		<?php } ?>
		<div class="site-info large-12 column">
			<span class="blank-theme-copyright-text"><?php echo blank_theme_copyright_text(); ?></span>
			<span class="sep"> | </span>
			<a class="blank-theme-author-footer" href="<?php echo esc_url( __( 'http://underscore-me.com/', 'blank-theme' ) ); ?>" target="_blank" >Blank Theme</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
