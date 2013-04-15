<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>
	<footer id="footer">
		<?php if ( !is_singular()): ?>
		<div class="footer-widget-section">
			<?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>
			<?php endif; ?>
			<?php if ( ! dynamic_sidebar( 'footer-2' ) ) : ?>
			<?php endif; ?>
			<?php if ( ! dynamic_sidebar( 'footer-3' ) ) : ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php wp_nav_menu( array(
			'theme_location' => 'bottom',
			'container'  => 'div',
			'container_class' => 'bottom-nav',
			'menu_class'  => 'bottom-menu',
			'fallback_cb'  => false
		) ) ?>
		<div class="site-info">
			<?php do_action( 'tuesday_credits' ); ?>
			<span id="scroll-top">TOP</span>
			<span class="powered-by">
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'tuesday' ); ?>"><?php printf( __( 'Proudly powered by %s', 'tuesday' ), 'WordPress' ); ?></a>
			</span>
			<span class="theme-author">
		<?php 	if ( !get_theme_mod( 'blogauthor' ) ) {
				printf( __( '%1$s theme by %2$s', 'tuesday' ), 'Tuesday', '<a href="//dimitarralev.net/">Dimitar Ralev</a>' );
			} else {
				echo get_theme_mod( 'blogauthor' );
			}
		?>
			</span>
		</div>
	</footer>