<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>
	<section class="post-content">
		<?php the_content(); ?>
	</section>
	<footer class="post-footer">
		<?php edit_post_link( __( 'Edit Post', 'tuesday' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>