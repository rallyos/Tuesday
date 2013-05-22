<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */

// Using twentytwelve solution for not showing comments if the post is protected, and password is not provided. 
if ( post_password_required() )
	return;
?>
	<section id="comments">
	<?php if ( have_comments() ) : ?>
		<h1 class="comments-count-header">
	<?php
		printf( _n( 'One comment on %2$s', '<span class="comments-count">%1$s</span> comments on %2$s', get_comments_number(), 'tuesday' ),
			number_format_i18n( get_comments_number() ), '<span class="comments-post-title">' . get_the_title() . '</span>' );
	?>
		</h1>
		<ul class="comments-list">
			<?php wp_list_comments( array( 'callback' => 'tuesday_comment' ) ); ?>
		</ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="site-navigation">
			<div class="nav-previous paging-navigation"><?php previous_comments_link( __( '&larr; Older Comments', 'tuesday' ) ); ?></div>
			<div class="nav-next paging-navigation"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tuesday' ) ); ?></div>
		</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'tuesday' ); ?></p>
	<?php endif; ?>
	<?php comment_form(array(
		'id_form' => 'comment-form',
		'fields' => array(
			'author' => '<p class="comment-form-author"><label class="form-label" for="author">' . __( 'Name', 'tuesday' ) . '' . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input class="form-input" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/></p>',
			'email' => '<p class="comment-form-email"><label class="form-label" for="email">' . __( 'Email', 'tuesday' ) . '</label><input class="form-input" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"/></p>',
			'url' => '<p class="comment-form-url"><label class="form-label" for="url">' . __( 'Website', 'tuesday' ) . '</label><input class="form-input" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
		),
		'comment_field' => '<p class="comment-form-comment"><label class="form-label" for="comment">' . __('Comment', 'tuesday') . '</label><textarea class="form-textarea" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>'
	)); ?>
	</section>