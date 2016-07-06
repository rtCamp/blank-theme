<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blank Theme
 */
if ( ! function_exists( 'blank_theme_posted_on' ) ) {
	function blank_theme_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );
		$posted_on = $time_string;

		return $posted_on;
	}
}

if ( ! function_exists( 'blank_theme_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blank_theme_entry_footer() {
		$posted_on = blank_theme_posted_on();
		$allowed_meta = get_theme_mod( 'blank_theme_manage_meta', array( 'author', 'date', 'comment' ) );

		$byline = sprintf( _x( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>', 'post author', 'blank-theme' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );

		$cat_links = false;
		$tags_list = false;

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'blank-theme' ) );
			if ( $categories_list && blank_theme_categorized_blog() ) {
				$cat_links = esc_html( $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '<ul class="blank-theme-tags"><li>', '</li><li>', '</li></ul>' );
		}

		if ( in_array( 'author', $allowed_meta, true ) ) {
			echo "<span class='byline blank-theme-meta-item blank-theme-icon-user'>" . $byline . "</span> ";
		}

		if ( in_array( 'date', $allowed_meta, true ) ) {
			echo "<span class='posted-on blank-theme-meta-item blank-theme-icon-calendar'>" . $posted_on . "</span> ";
		}

		if ( $cat_links && in_array( 'categories', $allowed_meta, true ) ) {
			echo "<span class='cat-links blank-theme-meta-item blank-theme-icon-category'>" . $cat_links . "</span> ";
		}
		if ( $tags_list && in_array( 'tags', $allowed_meta, true ) ) {
			echo "<span class='tag-links blank-theme-meta-item blank-theme-icon-tags'>" . $tags_list . "</span> ";
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && in_array( 'comment', $allowed_meta, true ) ) {
			echo '<span class="comments-link blank-theme-meta-item blank-theme-icon-comment">';
			comments_popup_link( esc_html__( 'Leave a comment', 'blank-theme' ), esc_html__( 'Comment (1)', 'blank-theme' ), esc_html__( 'Comments (%)', 'blank-theme' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'blank-theme' ), '<i class="edit-link">', '</i>' );
	}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function blank_theme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'blank_theme_categories' ) ) ) {
		$args = array(
			'fields'	 => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'	 => 2,
		);

		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( $args );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'blank_theme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so blank_theme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so blank_theme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in blank_theme_categorized_blog.
 */
function blank_theme_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'blank_theme_categories' );
}

add_action( 'edit_category', 'blank_theme_category_transient_flusher' );
add_action( 'save_post', 'blank_theme_category_transient_flusher' );
