<?php
/**
 *  Used for showing the slider
 *  @package Blank Theme
 */

$slides = get_theme_mod( 'blank_theme_slides' );

if( is_array($slides) && ( is_home() || is_front_page() ) ) : ?>

<div id="blank-theme-slider" class="blank-theme-slider clearfix">
	<ul class="blank-theme-slides cycle-slideshow clearfix" data-cycle-slides="li" data-cycle-prev=".blank-theme-prev" data-cycle-next=".blank-theme-next" data-cycle-log="false" data-cycle-fx="fade" data-cycle-pager=".blank-theme-cycle-pager" data-cycle-loader="true" data-cycle-pause-on-hover="true">

		<?php foreach( $slides as $slide ) :
			$link        = isset( $slide['link'] ) ? $slide['link'] : false;
			$title       = isset( $slide['title'] ) ? sprintf( '<h2 class="slide-title" ><a href="%s">%s</a></h2>' , esc_url( $link ), esc_html($slide['title']) ) : false;
			$description = isset( $slide['description']) ? sprintf( '<p class="slide-description"><a href="%s">%s</a></p>', esc_url( $link ) , esc_html( $slide['description'] ) ) : false;
			$image       = isset( $slide['image'] ) ? sprintf( '<img src="%s" alt="%s">' , esc_url( $slide['image'] ), __( 'Slide Image' , 'blank-theme' ) ) : false;
		 ?>
		<li class="blank-theme-slide">
			<?php echo $image; ?>
			<?php if( $title || $description ){ ?>
			<div class="blank-theme-slide-content">
				<div class="row">
					<?php echo $title . $description; ?>
				</div>
			</div>
			<?php } ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="blank-theme-cycle-pager clearfix"></div>

	<?php if( count($slides) ) { ?>
	<div class="blank-theme-prev"></div>
	<div class="blank-theme-next"></div>
	<?php } ?>

</div> <!-- #blank-theme-slider -->

<?php endif; ?>
