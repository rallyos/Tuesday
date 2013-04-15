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
	<footer>
		<h6 class="post-time"><?php tuesday_posted_on(); ?></h6>
		<?php edit_post_link( __( 'Edit Post', 'tuesday' ), '<span class="edit-aside">', '</span>' ); ?>
	</footer>
</article>