<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
 	 	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		<meta name="viewport" content="width=device-width" />
		<title><?php bloginfo('name'); ?><?php wp_title('-'); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
	<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>