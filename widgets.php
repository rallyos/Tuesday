<?php 
/**
 * widgets.php contains modified and theme specific widgets.
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */

/*=Tuesday tag cloud widget
* Default tag cloud widget is modified for nicer presentation of used tags.
* The widget also shows tag count by getting the count number from the title attribute.*/
function tuesday_tag_cloud( $args ) {
	$args['smallest'] = 0.8;
	$args['largest'] = 0.8;
	$args['unit'] = 'rem';
	$args['number'] = '10';
	$args['format'] = 'list';
	$args['orderby'] = 'count';
	$args['order'] = 'DESC';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'tuesday_tag_cloud' );

/*=Tuesday recent posts widget
* This widget shows recent posts with cards like design.
* Default wordpress widget is available too.*/
class Tuesday_Recent_Posts extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'tuesday_recent_posts',
			__('Tuesday Recent Posts', 'tuesday'),
			array( 'description' =>__( 'Shows recent posts with cards like design.', 'tuesday' ), )
		);
	}
	public function form( $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'Recent Posts', 'tuesday' );
		} 
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$comments = isset( $instance['comments'] ) ? (bool) $instance['comments'] : true;
		$date = isset( $instance['date'] ) ? (bool) $instance['date'] : true;
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'tuesday' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'tuesday' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>"<?php checked( $comments ); ?>>
			<label for="<?php echo $this->get_field_id( 'comments' ); ?>"><?php _e('Show post date', 'tuesday'); ?></label>		
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>"<?php checked( $date ); ?>>
			<label for="<?php echo $this->get_field_id(' date '); ?>"><?php _e('Show post comments', 'tuesday'); ?></label>
		</p>
	<?php
	}
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;
		if ( !empty( $title ) )
			echo $before_title . $title . $after_title;
		echo '<ul class="tuesday-recent-post-wrap">';
		/* Thanks to Michael Fields for the example on how to exclude other post formats.
		* http://wordpress.mfields.org/2011/post-format-queries/ */
		$formats = get_post_format_slugs();
		foreach ( (array) $formats as $i => $format ) {
			$formats[$i] = 'post-format-' . $format;
		}
		$recent_posts = wp_get_recent_posts( array(
				'numberposts' => $instance['number'],
				'post_type' => 'post',
				'post_status' => 'publish',
				'tax_query' => array(
					array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => $formats,
					'operator' => 'NOT IN'
				)
			)
		) );
		foreach ( $recent_posts as $recent ):
	?>
		<li class="tuesday-recent-post">
		<?php 	// Get post thumbnail & post title (with permalink) ?>
			<?php echo get_the_post_thumbnail( $recent["ID"], 'full', array( 'class' => "tuesday-recent-post-img" ) ); ?>
			<a class="tuesday-recent-post-header" href="<?php echo get_permalink( $recent["ID"] ) ?>" title="Look <?php echo esc_attr( $recent["post_title"] ) ?>"><?php echo $recent["post_title"] ?></a>
		<?php 	// Show post date? ?>
			<?php if ($instance['date']): ?>
			<span class="recent-post-date"><?php echo get_the_time( 'n / j', $recent["ID"] ) ?></span>
			<?php endif; ?>
		<?php 	// Show comments link? ?>
			<?php if ($instance['comments']): ?>
			<a class="recent-post-comments-link" href="<?php echo get_comments_link( $recent["ID"] ) ?>"><?php echo get_comments_number( $recent["ID"] ) ?></a>
			<?php endif; ?>
		</li>
	<?php
	 	endforeach;
		echo '</ul>';
		echo $after_widget;
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = $new_instance['number'];
		$instance['comments'] = !empty($new_instance['comments']) ? 1 : 0;
		$instance['date'] = !empty($new_instance['date']) ? 1 : 0;
		return $instance;
	}
}
register_widget( 'Tuesday_Recent_Posts' );


/*=Tuesday social media links
* Provides links to your social media profiles with their icons.*/
class Tuesday_Social_Links extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'tuesday_social_links',
			'Tuesday Social Links',
			array( 'description' =>__( 'Simple widget for your social media profiles.', 'tuesday' ), )
		);
	}
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'Follow Me', 'tuesday' );
		}
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'tuesday' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter username:', 'tuesday' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php if( isset($instance['twitter'])) { echo esc_attr( $instance['twitter'] );} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook url:', 'tuesday' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="url" value="<?php if( isset($instance['facebook'])) { echo esc_attr( $instance['facebook'] );} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'google-plus' ); ?>"><?php _e('Google Plus url:', 'tuesday' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'google-plus' ); ?>" name="<?php echo $this->get_field_name( 'google_plus' ); ?>" type="url" value="<?php if( isset($instance['google_plus'])) { echo esc_attr( $instance['google_plus'] );} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('Linkedin url:', 'tuesday' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php if( isset($instance['linkedin'])) { echo esc_attr( $instance['linkedin'] );} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'lastfm' ); ?>"><?php _e('Last.fm username:', 'tuesday' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'lastfm' ); ?>" name="<?php echo $this->get_field_name( 'lastfm' ); ?>" type="text" value="<?php if( isset($instance['lastfm'])) { echo esc_attr( $instance['lastfm'] );} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('Tumblr username:', 'tuesday' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" type="text" value="<?php if( isset($instance['tumblr'])) { echo esc_attr( $instance['tumblr'] );} ?>" />
		</p>
	<?php
	}
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( !empty( $title ) )
			echo $before_title . $title . $after_title;
		echo '<div class="social-container">';
		if ( !empty( $instance['twitter'] ) ) {
			echo '<a class="social-links" href="//twitter.com/'.$instance['twitter'].'" target="_blank"><img class="social-icons" src="'. get_template_directory_uri() .'/images/twitter.png" width="40" height="40" alt="Twitter"></a>';
		}
		if ( !empty( $instance['facebook'] ) ) {
			echo '<a class="social-links" href="'.$instance['facebook'].'" target="_blank"><img class="social-icons" src="'. get_template_directory_uri() .'/images/facebook.png" width="40" height="40" alt="Facebook"></a>';
		}
		if ( !empty( $instance['google_plus'] ) ) {
			echo '<a class="social-links" href="'.$instance['google_plus'].'" target="_blank"><img class="social-icons" src="'. get_template_directory_uri() .'/images/googleplus.png" width="40" height="40" alt="GooglePlus"></a>';
		}
		if ( !empty( $instance['linkedin'] ) ) {
			echo '<a class="social-links" href="'.$instance['linkedin'].'" target="_blank"><img class="social-icons" src="'. get_template_directory_uri() .'/images/linkedin.png" width="40" height="40" alt="Linkedin"></a>';
		}
		if ( !empty( $instance['lastfm'] ) ) {
			echo '<a class="social-links" href="//last.fm/user/'.$instance['lastfm'].'" target="_blank"><img class="social-icons" src="'. get_template_directory_uri() .'/images/lastfm.png" width="40" height="40" alt="Lastfm"></a>';
		}
		if ( !empty( $instance['tumblr'] ) ) {
			echo '<a class="social-links" href="//'.$instance['tumblr'].'.tumblr.com'.'" target="_blank"><img class="social-icons" src="'. get_template_directory_uri() .'/images/tumblr.png" width="40" height="40" alt="Tumblr"></a>';
		}
		echo '</div>';
		echo $after_widget;
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['google_plus'] = strip_tags( $new_instance['google_plus'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['lastfm'] = strip_tags( $new_instance['lastfm'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		return $instance;
	}
}
register_widget( 'Tuesday_Social_Links' );