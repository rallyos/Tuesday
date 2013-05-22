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
		<?php if ( is_sticky() ): ?>
		<span class="sticky-label"><?php _e('Featured','tuesday') ?></span>
		<?php endif; ?>
		<hgroup class="post-header">
			<h1 class="post-title"><a class="post-title-permalink" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'tuesday' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php if ( 'post' == get_post_type() ) : ?>
			<h6 class="post-time"><?php tuesday_posted_on(); ?></h6>
			<?php endif; ?>
		</hgroup>
	</header>
	<section class="post-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		<?php if ( has_excerpt() ) : ?>
			<?php the_excerpt(); ?>
			<a class="more-link" href="<?php echo get_permalink(); ?>">Continue reading &rarr;</a>
		<?php else: ?> 
			<?php the_content( __( 'Continue reading &rarr;', 'tuesday' ) ); ?>
		<?php endif; ?>
	</section>
	<footer class="post-footer">
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
		<?php wp_link_pages( array( 'before' => '<div class="post-pages-nav">'.__( 'Pages:', 'tuesday' ), 'after' => '</div>' ) ); ?>
	</footer>
</article>