<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<section class="post-content">
			<?php the_content(); ?>
		</section>
		<footer class="post-footer">
			<h6 class="post-time"><?php tuesday_posted_on(); ?></h6>
			<div class="category-comment">
				<?php if ( 'post' == get_post_type() ) : ?>
				<?php $categories_list = get_the_category_list( __( ' ', 'tuesday' ) );
					if ( $categories_list && tuesday_categorized_blog() ) : ?>
					<div class="cat-links">
						<?php printf( __( '%1$s', 'tuesday' ), $categories_list ); ?>
					</div>
					<?php endif; ?>
				<?php endif;  ?>
			</div>
				<?php edit_post_link( __( 'Edit Post', 'tuesday' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>
</article>