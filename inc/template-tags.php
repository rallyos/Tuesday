<?php
/**
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */

if ( ! function_exists( 'tuesday_content_nav' ) ):
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Tuesday 1.0
	 */
	function tuesday_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;

?>
	<div role="navigation" id="<?php echo $nav_id; ?>" class="site-navigation">
	<?php if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous paging-navigation"><?php next_posts_link( __( '<span>&larr;</span> Older posts', 'tuesday' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next paging-navigation"><?php previous_posts_link( __( 'Newer posts <span>&rarr;</span>', 'tuesday' ) ); ?></div>
		<?php endif; ?>
	<?php endif; ?>
	</div>
	<?php
	}
endif;

if ( ! function_exists( 'tuesday_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Tuesday 1.0
	 */
	function tuesday_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( 'Pingback:', 'tuesday' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'tuesday' ), ' ' ); ?></p>
	<?php
		break;
	default : 
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article class="comment-body" id="comment-<?php comment_ID(); ?>">
			<div class="user-avatar">
				<?php echo get_avatar( $comment, 90 ); ?>
			</div>
			<section class="comment-content">
				<div class="comment-header">
					<?php printf( __( '%s', 'tuesday' ), sprintf( '<span class="comment-author">%s</span>', get_comment_author_link() ) ); ?>
				</div>
				<div class="comment-text">
					<?php comment_text(); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<span class="awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tuesday' ); ?></span>
					<?php endif; ?>
				</div>
				<div class="comment-footer">
					<a class="post-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>"> <?php printf( __( '%1$s %2$s', 'tuesday' ), get_comment_date(), get_comment_time() ); ?></time>
					</a>
					<span class="reply-link">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
						<?php edit_comment_link( __( 'Edit', 'tuesday' ), ' ' ); ?>
				</div>
			</section>
		</article>
	<?php
		break;
		endswitch;
	}
endif;

if ( ! function_exists( 'tuesday_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Tuesday 1.0
	 */
	function tuesday_posted_on() {
		printf( __( '<a class="post-time-links" href="%1$s" title="%2$s" rel="bookmark"><time class="post-time-links" datetime="%3$s">%4$s</time></a><span class="by-author post-time-links"> by <span class="author vcard post-time-links"><a class="url fn n post-time-links" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'tuesday'),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'tuesday' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	}
endif;

/**
 * Markup for one-column layout design.
 *
 * @since Tuesday 1.0
 */
function tuesday_one_column() {
	?>		<div id="logo-head">
			<?php // Load blog logo, name and description if set ?>
			<?php if ( get_theme_mod('site_logo') ): ?>
				<a class="logo" href="<?php echo home_url(); ?>">
					<img class="logo-image" src="<?php echo get_theme_mod('site_logo'); ?>" alt="logo">
				</a>
			<?php endif; ?>
			<?php if ( get_bloginfo( 'name' ) ): ?>
				<h1 class="site-title"><?php echo bloginfo( 'name' ); ?></h1>
			<?php endif; ?>
			<?php if ( get_bloginfo( 'description' ) ): ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
			</div>
			<?php
}
/**
 * Returns true if blog has more than one category.
 *
 * @since Tuesday 1.0
 */
function tuesday_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so tuesday_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so tuesday_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in tuesday_categorized_blog
 *
 * @since Tuesday 1.0
 */
function tuesday_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'tuesday_category_transient_flusher' );
add_action( 'save_post', 'tuesday_category_transient_flusher' );
