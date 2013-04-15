<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1 class="aside-title"><?php the_title(); ?></h1>
		</header>
		<section class="post-content">
			<?php the_content(); ?>
		</section>
		<footer class="aside-footer">
			<h5 class="aside-time"><?php tuesday_posted_on(); ?></h5>
			<?php edit_post_link( __( 'Edit Post', 'tuesday' ), '<span class="edit-aside">', '</span>' ); ?>
		</footer>
</article>