<?php

class ceres_static_banner extends WP_Widget {

/*  Ceres Static Banner Setup  */

	function __construct() {
		parent::__construct(false, $name = esc_html__('Ceres Static Banner', 'ceres' ), array(
			'description' => esc_html__('Widget for adding a static banner', 'ceres' )
		));
	}

/*  Display Ceres Static Banner  */

	public function widget( $args, $instance ) {

		extract( $args );

		$static_banner_img = apply_filters('static_banner_img', $instance['static_banner_img'] );
		$static_banner_link = apply_filters('static_banner_link', $instance['static_banner_link'] );

		?>

		<div class="space-ad-place cont relative">
			<div class="space-ad-place-ins relative">
				<div class="space-ad-place-banner relative">
					<?php if ($static_banner_img != '') {echo '<a href="'. esc_url($instance['static_banner_link']) . '" title=" " target="_blank"><img src="'. esc_url($instance['static_banner_img']) . '" alt="" /></a>';} ?>
				</div>
				<div class="space-ad-place-title relative">
					<?php esc_html_e( 'Advertisement', 'ceres' ); ?>
				</div>
			</div>
		</div>

		<?php
	}	

/*  Update Ceres Static Banner  */

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['static_banner_img'] = strip_tags( $new_instance['static_banner_img'] );
		$instance['static_banner_link'] = strip_tags( $new_instance['static_banner_link'] );
		return $instance;
	}

/*  Ceres Static Banner Input Form  */

	public function form( $instance ) {

		$defaults = array(
		'static_banner_img' => '',
		'static_banner_link' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'static_banner_img' )); ?>"><strong><?php esc_html_e('Url to banner image:', 'ceres') ?></strong></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('static_banner_img')); ?>" name="<?php echo esc_attr($this->get_field_name('static_banner_img')); ?>" value="<?php echo esc_attr($instance['static_banner_img']); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'static_banner_link' )); ?>"><strong><?php esc_html_e('Link to banner:', 'ceres') ?></strong></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('static_banner_link')); ?>" name="<?php echo esc_attr($this->get_field_name('static_banner_link')); ?>" value="<?php echo esc_attr($instance['static_banner_link']); ?>" /></p>

	<?php
	}	
}

function register_ceres_static_banner() {
	register_widget( 'ceres_static_banner' );
}

add_action( 'widgets_init', 'register_ceres_static_banner' );