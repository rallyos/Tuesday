<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>
	
	<header>
		<h1 class="results nothing-found"><?php _e( 'Nothing Found', 'tuesday' ); ?></h1>		
	</header>
	<div class="no-results">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p class="no-results-message"><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tuesday' ), admin_url( 'post-new.php' ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p class="no-results-message"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tuesday' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p class="no-results-message"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tuesday' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>