<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */
function tuesday_customize_register( $wp_customize ) {
	
	// Upload site logo
	$wp_customize->add_section( 'site_logo', array(
			'title'  => __( 'Site Logo', 'tuesday' ),
			'priority' => 20,
	) );
	$wp_customize->add_setting( 'site_logo');
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
				'label'  =>__( 'Upload Logo', 'tuesday' ),
				'section' => 'site_logo',
				'settings' => 'site_logo',
	) ) );

	// Preferred logo size
	class Tuesday_Customize_Site_Logo_Control extends WP_Customize_Control {
		public function render_content() {
				echo __('Preferred size - 300x300 px.', 'tuesday');
		}
	}
	$wp_customize->add_setting( 'logo_size' );
	$wp_customize->add_control( new Tuesday_Customize_Site_Logo_Control( $wp_customize, 'logo_size', array(
				'label'  => __( 'Size', 'tuesday' ),
				'section' => 'site_logo',
				'settings' => 'logo_size',
	) ) );		

	// Changing transport for 'blogname' and 'blogdescription'
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Change copyright text in the footer
	$wp_customize->add_setting( 'blogauthor', array(
			'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blogauthor', array(
				'label'  => __( 'Author', 'tuesday' ),
				'section' => 'title_tagline',
				'settings' => 'blogauthor',
	) ) );

	// Switch layouts
	$wp_customize->add_section( 'custom-layouts', array(
			'title'  => __( 'Layout', 'tuesday' ),
			'priority' => 21,
	) );
	$wp_customize->add_setting( 'custom-layouts', array(
			'default' => 'sidebar-left',
	) );
	$wp_customize->add_control( 'custom-layouts', array(
			'label'      => __( 'Change layout', 'tuesday' ),
			'section'    => 'custom-layouts',
			'settings'   => 'custom-layouts',
			'type'       => 'radio',
			'choices'    => array(
				'sidebar-left' => __('Sidebar on left', 'tuesday'),
				'sidebar-right' => __('Sidebar on right', 'tuesday'),
				'one-column' => __('One Column', 'tuesday'),
		),
	) );

	/* Select font
	* Message */
	class Tuesday_Customize_Font_Message_Control extends WP_Customize_Control {
		public function render_content() {
				echo __(' Tuesday is using Google Web Fonts. You can find and test your favourite font <a href="//www.google.com/fonts/" target="_blank">here</a>, before setting it to the page. ');
		}
	}
	$wp_customize->add_setting( 'font-message' );
	$wp_customize->add_control( new Tuesday_Customize_Font_Message_Control( $wp_customize, 'font-message', array(
				'label'  => __( 'Using:', 'tuesday' ),
				'section' => 'font',
				'settings' => 'font-message',
	) ) );	
	/* Select font
	* Show currently using : [font] text */
	class Tuesday_Customize_Font_Text_Control extends WP_Customize_Control {
		public function render_content() {
				echo __('Currently using : '. get_theme_mod('font', 'Open Sans') .'');
		}
	}
	$wp_customize->add_setting( 'currently-using' );
	$wp_customize->add_control( new Tuesday_Customize_Font_Text_Control( $wp_customize, 'currently-using', array(
				'label'  => __( 'Using:', 'tuesday' ),
				'section' => 'font',
				'settings' => 'currently-using',
	) ) );	
	/* Select font
	* Enqueue the needed scripts */
	class Tuesday_Customize_Font_Control extends WP_Customize_Control {
		public function enqueue() {
			wp_enqueue_script( 'fonts_javascript', get_template_directory_uri() . '/js/fonts-loader.js', array( 'jquery' ));
			wp_enqueue_script( 'google-client-library', 'https://apis.google.com/js/client.js');
		}
	}
	/* Select font
	* Create empty select list which will be filled with font names */
	$wp_customize->add_section('font', array(
			'title' => __( 'Font', 'tuesday' ),
			'priority' => 22,
	) );
	$wp_customize->add_setting('font', array(
			'default' => 'Open Sans',
	) );
	$wp_customize->add_control( new Tuesday_Customize_Font_Control( $wp_customize, 'font', array(
				'label' => __( 'Change Font', 'tuesday' ),
				'section' => 'font',
				'settings' => 'font',
				'type' => 'select',
				'choices' => array(
					''  => '',
				),
	) ) );
	/* Select font
	* Select desired font weight for post content */
	$wp_customize->add_setting('font-weight', array(
			'default' => '400',
			'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'font-weight', array(
				'label' => __( 'Post Text - Font Variant (If Available) ', 'tuesday' ),
				'section' => 'font',
				'settings' => 'font-weight',
				'type' => 'radio',
				'choices' => array(
					'300'  => __('Book', 'tuesday'),
					'400'  => __('Normal', 'tuesday'),
				),
	) );
	/* Select font
	* Include other font subsets */
	$wp_customize->add_setting( 'font-subset');
	$wp_customize->add_control( 'font-subset', array(
			'label'      => __( 'Include Font Subset (If Available)', 'tuesday' ),
			'section'    => 'font',
			'settings'   => 'font-subset',
			'type'       => 'radio',
			'choices'    => array(
				'cyrillic' => __('Cyrillic', 'tuesday'),
				'greek' => __('Greek', 'tuesday'),
				'vietnamese' => __('Vietnamese', 'tuesday'),
				'' => __('None', 'tuesday'),
		),
	) );

	// Add header image
	$wp_customize->add_section( 'header_image', array(
			'title'  =>__( 'Header Image', 'tuesday' ),
			'priority' => 23,
	) );
	$wp_customize->add_setting( 'header_image', array(
			'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Header_Image_Control( $wp_customize, 'header_image', array(
				'label'  => __( 'Header Image', 'tuesday' ),
				'section' => 'header_image',
				'settings' => 'header_image',
	) ) );

	// Add background image 
	$wp_customize->add_section( 'background_image', array(
			'title'  => __( 'Background Image', 'tuesday' ),
			'priority' => 24,
	) );
	$wp_customize->add_setting( 'background_image', array(
			'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Background_Image_Control( $wp_customize, 'background_image', array(
				'label'  => __( 'Background Image', 'tuesday' ),
				'section' => 'background_image',
				'settings' => 'background_image',
	) ) );
	/* Background Image 
	* Plugin recommendation */
	class Tuesday_Customize_Text_Control extends WP_Customize_Control {
		public function render_content() {
			if ( !is_plugin_active( 'subtle-background-patterns/subtle_backgrounds.php' ) ) {
				echo __('Highly recommended plugin for better background experience <a href="http://wordpress.org/extend/plugins/subtle-background-patterns/">Subtle Background Patterns</a>', 'tuesday');
			}
		}
	}
	$wp_customize->add_setting( 'recommend_plugin');
	$wp_customize->add_control( new Tuesday_Customize_Text_Control( $wp_customize, 'recommend_plugin', array(
				'label'  => __( 'Recommended Plugin', 'tuesday' ),
				'section' => 'background_image',
				'settings' => 'recommend_plugin',
	) ) );	
	/* Background Image 
	* Add box shadow to container if background is set. */
	$wp_customize->add_setting( 'box-shadow', array(
				'default' => true,
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'box-shadow', array(
				'label'  =>__( 'Enable Box Shadow', 'tuesday' ),
				'section' => 'background_image',
				'settings' => 'box-shadow',
				'type'  => 'checkbox',
				'choices' => array(
					'box-shadow'  => __('Box Shadow', 'tuesday')
				),
	) ) );

	// Add background color
	$wp_customize->add_section( 'background_color', array(
			'title'  => __( 'Background Color', 'tuesday' ),
			'priority' => 25,
	) );
	$wp_customize->add_setting( 'background_color', array(
			'default' => 'f7f7f7',
			'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
				'label'  => __( 'Background Color', 'tuesday' ),
				'section' => 'background_color',
				'settings' => 'background_color',
	) ) );

	// Outputs the javascript needed to automate the live settings preview
	function tuesday_customizer_live_preview() {
		wp_enqueue_script( 'tuesday_customizer', get_template_directory_uri().'/js/theme-customizer.js',
		array( 'jquery','customize-preview' ),'',true
		);
	}
	add_action( 'customize_preview_init', 'tuesday_customizer_live_preview' );
}
add_action( 'customize_register', 'tuesday_customize_register' );

// Output generated css
function tuesday_customize_css() {
?>
         <style type="text/css">
         		body { font-family: <?php echo get_theme_mod('font', 'Open Sans'); ?>, sans-serif;}
         		.post-content > p { font-weight: <?php echo get_theme_mod('font-weight','400') ?>;}
           		body { background-color: #<?php echo get_theme_mod( 'background_color', 'f7f7f7'); ?>; }
           		body { background-image: url(<?php echo get_theme_mod( 'background_image' ); ?>); }
	<?php if ( ( get_theme_mod( 'background_image' ) || get_theme_mod( 'background_color', 'f7f7f7' ) ) && get_theme_mod( 'box-shadow', true ) ): ?>
           		#wrapper { box-shadow: 0 0 7px 1px rgba(179,179,179,0.5); }
	<?php endif; ?>
         	</style>
    <?php
}
add_action( 'wp_head', 'tuesday_customize_css' );
