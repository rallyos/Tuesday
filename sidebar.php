<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>
		<aside id="sidebar">
			<?php if ( get_theme_mod('site_logo') || get_bloginfo( 'name' ) || get_bloginfo( 'description' ) ): ?>
			<div id="logo-head">
				<?php // Load blog logo, name and description if set ?>
				<?php if ( get_theme_mod('site_logo') ): ?>
					<a class="logo" href="<?php echo home_url(); ?>">
						<img class="logo-image" src="<?php echo get_theme_mod('site_logo'); ?>" alt="logo" width="150" height="150">
					</a>
				<?php endif; ?>
				<?php if ( get_bloginfo( 'name' ) ): ?>
					<h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php echo bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
				<?php if ( get_bloginfo( 'description' ) ): ?>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php wp_nav_menu( array(
				'theme_location' => 'sidebar',
				'container'  => 'nav',
				'container_class' => 'sidebar-nav',
				'menu_class'  => 'sidebar-menu',
				'fallback_cb'  => false
			) ) ?>
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
			<?php endif; ?>
		</aside>