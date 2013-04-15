<?php
/**
 * @package Tuesday
 * @since Tuesday 1.0
 */

get_header(); ?>
	<div id="wrapper">
		<section class="landing-404">
			<hgroup>
				<h1 class="header-404">404</h1>
				<h2 class="message-404"><?php _e("It looks that you still haven't found what you're looking for.",'tuesday') ?></h2>
			</hgroup>
			<?php get_search_form(); ?>
		</section>
		<?php get_footer(); ?>
	</div>