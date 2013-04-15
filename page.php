<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */

get_header(); ?>

	<div id="wrapper">
		<header class="page-header">
		<?php // Menu button on mobile and tablet view  ?>
			<?php if ( get_theme_mod( 'custom-layouts', 'sidebar-left' ) != 'one-column' ): ?>
			<div id="menu-button">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
			</div>
			<?php endif; ?>
		<?php 	// Load header only if it has menu or image set
			if ( has_nav_menu( 'top' ) ): ?>
			<span id="toggle-menu">Menu</span>
			<?php wp_nav_menu( array(
				'theme_location' => 'top',
				'container'  => 'nav',
				'container_class' => 'top-nav',
				'menu_class'  => 'top-menu',
				'fallback_cb'  => false
			) ) ?>
			<?php endif; ?>
			<?php if ( get_header_image() ): ?>
				<img class="image-header" src="<?php header_image(); ?>">
			<?php endif; ?>
		</header>
		<?php  // Load markup based on layout setting
			if ( get_theme_mod( 'custom-layouts' ) != 'one-column' ):
				get_sidebar();
			elseif  ( get_theme_mod( 'custom-layouts' ) == 'one-column' ):
				tuesday_one_column(); // This function can be found in inc/template-tags.php
			endif;
		?>			
			<section id="content">
		<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page' );
				endwhile;
				if ( comments_open() || '0' != get_comments_number() ) {
							comments_template( '', true );
				}
			?>
			</section>
		<?php get_footer(); ?>
		</div>
<?php wp_footer(); ?>
</body>
</html>