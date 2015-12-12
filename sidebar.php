<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Blank Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

?>

<div id="secondary" class="<?php blank_theme_secondary_classes(); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
