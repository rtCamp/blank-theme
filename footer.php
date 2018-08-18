<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package blank-theme
 */

?>

</div><!-- #content -->
</div><!-- .grid-container -->

<footer id="colophon" class="site-footer grid-container grid-container-padded" role="contentinfo">

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside class="rtp-footer-widgets row grid-x grid-margin-x">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside>
	<?php } ?>

	<div class="site-info row grid-x grid-margin-x">
		<div class="cell column">
			<span class="blank-theme-copyright-text">
				<?php
				$theme_uri = 'https://rtcamp.com/';

				/* translators: 1: Theme name, 2: Theme author. */
				$default        = sprintf( esc_html__( '%1$s by %2$s', 'blank-theme' ), esc_html__( 'Blank Theme', 'blank-theme' ), '<a href="' . esc_url( $theme_uri ) . '" rel="designer">' . esc_html__( 'rtCamp', 'blank-theme' ) . '</a>' );
				$copyright_text = get_theme_mod( 'blank_theme_copyright_text', $default );

				echo $copyright_text; /* WPCS: xss ok. */
				?>
			</span>
			<span class="sep">&nbsp;|&nbsp;</span>
			<a class="blank-theme-author-footer" href="<?php echo esc_url( 'https://rtcamp.com/' ); ?>" target="_blank"><?php esc_html_e( 'Blank Theme', 'blank-theme' ); ?></a>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<div class="blank-theme-back-to-top" id="blank-theme-back-to-top"></div>

<?php wp_footer(); ?>

</body>
</html>
