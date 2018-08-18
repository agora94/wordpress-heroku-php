<?php

class ceres_widget_1 extends WP_Widget {

/*  Ceres Widget #1 Setup  */

	function ceres_widget_1() {
		parent::__construct(false, $name = esc_html__('Ceres Widget #1', 'ceres' ), array(
			'description' => esc_html__('Homepage Widget #1', 'ceres' )
		));
	}

/*  Display Ceres Widget #1  */

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Widget #1', 'ceres' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 1;
		if ( ! $number )
			$number = 1;
		$categories = isset( $instance['cats_id'] ) ? $instance['cats_id'] : '';

		$category_link = get_category_link( $categories );
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'cat'      => $categories,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
		?>

			<div class="space-widget-1 cont relative">

			<?php while ( $r->have_posts() ) : $r->the_post(); ?>

					<div class="space-widget-1-ins white-15 relative">
						<div class="space-widget-1-img box-66 right relative">
							<?php $widget_1_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-widget-1'); if ($widget_1_thumbnail) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>"><img src="<?php echo esc_url($widget_1_thumbnail[0]); ?>" alt="<?php get_the_title() ? the_title() : the_ID(); ?>"></a>
							<?php } else {} ?>
						</div>
						<div class="space-widget-1-meta box-33 right initial">
							<div class="space-widget-1-meta-top relative">
								<div class="space-widget-1-category relative"><?php the_category(', '); ?></div>
								<div class="space-widget-1-title relative"><a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></div>
								<div class="space-widget-1-author space-common-meta relative"><i class="fa fa-user-o" aria-hidden="true"></i> <?php the_author_posts_link(); ?></div>
							</div>
							<div class="space-widget-1-meta-bottom absolute">
								<div class="space-widget-1-meta-bottom-data space-common-meta relative">
									<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?>
									<span class="space-widget-1-comment"><i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span>
									<span class="space-widget-1-views"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?php if(function_exists('ceres_setPostViews')) { echo ceres_getPostViews(get_the_ID()); }?></span>
								</div>
							</div>
						</div>
					</div>

			<?php endwhile; ?>

			</div>

		<?php
		wp_reset_postdata();
		endif;
	}

/*  Update Ceres Widget #1  */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['cats_id'] = (int) $new_instance['cats_id'];
		return $instance;
	}

/*  Ceres Widget #1 Settings Form  */

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 1;
		$cats = get_categories();
		$categories = isset( $instance['cats_id'] ) ? $instance['cats_id'] : '';
?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'ceres' ); ?></label>
		<input class="widefat" id="<?php echo esc_html($this->get_field_id( 'title' )); ?>" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php esc_html_e('Select Category:' , 'ceres' );?></label>
		<select id="<?php echo $this->get_field_id( 'cats_id' ); ?>" name="<?php echo $this->get_field_name( 'cats_id' ); ?>">
 		<option value=""><?php esc_html_e('All' , 'ceres' );?></option>
			<?php foreach ( $cats as $cat ) {?>
			<option value="<?php echo $cat->term_id ?>"<?php echo selected( $categories, $cat->term_id, false ) ?>> <?php echo esc_html( $cat->name ) ?></option>
			<?php }?>
 		</select></p>

 		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'ceres' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_html($this->get_field_id( 'number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_html($number); ?>" size="3" /></p>

<?php

	}
}

add_action( 'widgets_init', 'ceres_widget_1' );

function ceres_widget_1() {
	register_widget( 'ceres_widget_1' );
}