<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package blanktheme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$sidebar_position_class = get_theme_mod( 'blank_theme_sidebar_position', 'right' );

?>

<div id="secondary" class="widget-area large-4 column <?php echo esc_attr($sidebar_position_class); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
