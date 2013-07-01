<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>
<article id="post-<?php the_ID();?>" <?php post_class(); ?>>
	<header>
		<hgroup>
			<?php the_title('<h1 class="post-title">','</h1>'); ?>
			<h6 class="post-time"><?php tuesday_posted_on(); ?></h6>
		</hgroup>	
	</header>
	<section class="post-content">
		<?php the_content(); ?>
	</section>
	<footer>
		<div class="category-comment">
			<?php if ( 'post' == get_post_type() ) : ?>
			<?php $categories_list = get_the_category_list( __( ' ', 'tuesday' ) );
				if ( $categories_list && tuesday_categorized_blog() ) : ?>
				<div class="cat-links">
					<?php printf( __( '%1$s', 'tuesday' ), $categories_list ); ?>
				</div>
				<?php endif; ?>
			<?php endif;  ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'tuesday' ), __( '1 Comment', 'tuesday' ), __( '% Comments', 'tuesday' ) ); ?></span>
			<?php endif; ?>
		</div>
		<?php edit_post_link( __( 'Edit Post', 'tuesday' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>