<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="post-header">
			<hgroup>
				<?php the_title('<h1 class="post-title">','</h1>'); ?>
				<h6 class="post-time"><?php tuesday_posted_on(); ?></h6>
			</hgroup>			
		</header>
	<section class="post-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		<?php the_content(); ?>
	</section>
	<footer class="post-footer">
		<div class="category-comment">
			<div class="cat-links">
			<?php $category_list = get_the_category_list( __( ' ', 'tuesday' ) ); ?>
			<?php printf( __( '%1$s', 'tuesday' ), $category_list ); ?>
			</div>
		</div>
		<div class="tag-links tag-links-single">
			<?php $tag_list = get_the_tag_list( '', ' ' ); ?>
			<?php printf( __( '%1$s', 'tuesday' ), $tag_list ) ; ?>
		</div>
			<?php edit_post_link( __( 'Edit Post', 'tuesday' ), '<span class="edit-link">', '</span>' ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="post-pages-nav">'.__( 'Pages:', 'tuesday' ), 'after' => '</div>' ) ); ?>
		<div class="share-post">
			<div class="social-button">
				<div id="fb-root"></div>
				<div class="fb-like" data-send="false" data-layout="button_count" data-width="75" data-show-faces="false"></div>
			</div>
			<div class="social-button">
				<a href="//twitter.com/share" class="twitter-share-button">Tweet</a>
			</div>
			<div class="social-button">
				<div class="g-plusone" data-size="medium"></div>
			</div>
		</div>
	</footer>
</article>
<?php next_post_link('<div class="nav-previous post-nav"> &larr; %link</div>'); ?>
<?php previous_post_link('<div class="nav-next post-nav">%link &rarr; </div>'); ?>