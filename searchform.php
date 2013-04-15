<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>
	<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" name="s" class="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search', 'tuesday' ); ?>" />
		<input type="submit" name="submit" class="search-submit" value="<?php esc_attr_e( 'GO', 'tuesday' ); ?>" />
	</form>