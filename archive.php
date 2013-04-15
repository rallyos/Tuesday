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
			<?php if ( have_posts() ) : ?>
				<header>
					<h1 class="results">
			<?php 	if ( is_category() ) {
					printf( __( 'Category Archives: %s', 'tuesday' ), '<span class="keyword">' . single_cat_title( '', false ) . '</span>' );
				} elseif ( is_tag() ) {
					printf( __( 'Tag Archives: %s', 'tuesday' ), '<span class="keyword">' . single_tag_title( '', false ) . '</span>' );
				} elseif ( is_author() ) {
					the_post();
					printf( __( 'Author Archives: %s', 'tuesday' ), '<span class="keyword vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
					rewind_posts();
				} elseif ( is_day() ) {
					printf( __( 'Daily Archives: %s', 'tuesday' ), '<span class="keyword">' . get_the_date() . '</span>' );
				} elseif ( is_month() ) {
					printf( __( 'Monthly Archives: %s', 'tuesday' ), '<span class="keyword">' . get_the_date( 'F Y' ) . '</span>' );
				} elseif ( is_year() ) {
					printf( __( 'Yearly Archives: %s', 'tuesday' ), '<span class="keyword">' . get_the_date( 'Y' ) . '</span>' );
				} else {
					_e( 'Archives', 'tuesday' );
				}
			?>
					</h1>
			<?php
				if ( is_category() ) {
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

				} elseif ( is_tag() ) {
					$tag_description = tag_description();
					if ( ! empty( $tag_description ) )
						echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
				}
			?>	
				</header>
				<?php tuesday_content_nav( 'nav-above' ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
					<?php tuesday_content_nav( 'nav-below' ); ?>
				<?php else : ?>
				<?php get_template_part( 'no-results', 'archive' ); ?>
			<?php endif; ?>
			</section>
		<?php get_footer(); ?>
		</div>
<?php wp_footer(); ?>
</body>
</html>