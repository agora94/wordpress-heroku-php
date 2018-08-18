<?php

class ceres_ccpw extends WP_Widget {

/*  CCPW shortcode Setup  */

	function __construct() {
		parent::__construct(false, $name = esc_html__('For CCPW shortcode', 'ceres' ), array(
			'description' => esc_html__('Widget for adding a CCPW shortcode', 'ceres' )
		));
	}

/*  Display CCPW shortcode  */

	public function widget( $args, $instance ) {

		extract( $args );

		$ccpw_shortcode = apply_filters('ccpw_shortcode', $instance['ccpw_shortcode'] );

		?>

		<div class="space-ccpw cont relative">
			<div class="space-ccpw-ins white-15 relative">
				<?php
					$shortcode_id = esc_attr($instance['ccpw_shortcode']);
					echo do_shortcode('[ccpw id="'.$shortcode_id.'"]');
				?>
			</div>
		</div>

		<?php
	}	

/*  Update CCPW shortcode  */

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['ccpw_shortcode'] = strip_tags( $new_instance['ccpw_shortcode'] );
		return $instance;
	}

/*  CCPW shortcode Input Form  */

	public function form( $instance ) {

		$defaults = array(
		'ccpw_shortcode' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'ccpw_shortcode' )); ?>"><strong><?php esc_html_e('Cryptocurrency Price Shortcode ID', 'ceres') ?></strong></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('ccpw_shortcode')); ?>" name="<?php echo esc_attr($this->get_field_name('ccpw_shortcode')); ?>" value="<?php echo $instance['ccpw_shortcode']; ?>" /></p>

	<?php
	}	
}

function register_ceres_ccpw() {
	register_widget( 'ceres_ccpw' );
}

add_action( 'widgets_init', 'register_ceres_ccpw' );