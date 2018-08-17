<?php

class ceres_widget_7 extends WP_Widget {

/*  Ceres Widget #7 Setup  */

	function ceres_widget_7() {
		parent::__construct(false, $name = esc_html__('Ceres Widget #7', 'ceres' ), array(
			'description' => esc_html__('Homepage Widget #7', 'ceres' )
		));
	}

/*  Display Ceres Widget #7  */

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Widget #7', 'ceres' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$categories = isset( $instance['cats_id'] ) ? $instance['cats_id'] : '';

		$category_link = get_category_link( $categories );
		$r1 = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => 1,
			'cat'      => $categories,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );
		$r2 = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => 2,
			'cat'      => $categories,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'offset'	=> 1,
			'ignore_sticky_posts' => true
		) ) );

		if ($r1->have_posts()) :
		?>

				<div class="space-widget-7 cont relative">
					<div class="space-widget-7-big box-66 left relative">
						<?php while ( $r1->have_posts() ) : $r1->the_post(); ?>
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>">
							<div class="space-widget-7-big-ins white-15 relative">
								<div class="space-widget-7-big-img-wrap cont relative">
									<?php $widget_7_big_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-widget-7-big'); if ($widget_7_big_thumbnail) { ?>
									<img src="<?php echo esc_url($widget_7_big_thumbnail[0]); ?>" alt="<?php get_the_title() ? the_title() : the_ID(); ?>">
									<?php } ?>
									<div class="space-overlay absolute"></div>
									<div class="space-overlay-gradient absolute"></div>
									<div class="space-widget-7-big-cat absolute"><span><?php if ($categories) { ?><?php echo esc_html(get_cat_name( $categories )) ?><?php } else { ?><?php esc_html_e( 'Latest News', 'ceres' ); ?><?php } ?></span></div>
									<div class="space-widget-7-big-meta absolute">
										<div class="space-widget-7-date space-common-meta relative">
											<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?>
										</div>
										<div class="space-widget-7-big-title relative">
											<?php get_the_title() ? the_title() : the_ID(); ?>
										</div>
										<div class="space-widget-7-excerpt relative">
											<?php echo esc_html(wp_trim_words( get_the_excerpt(), 30, ' ...' )); ?>
										</div>
									</div>
								</div>
							</div>
						</a>
						<?php
							endwhile;
							wp_reset_postdata();
						?>
					</div>
					<div class="space-widget-7-small box-33 left relative">
						<div class="space-widget-7-small-ins cont relative">
							<?php while ( $r2->have_posts() ) : $r2->the_post(); ?>
							<div class="space-widget-7-small-item relative">
								<a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>">
									<div class="space-widget-7-small-item-ins white-15 relative">
										<div class="space-widget-7-small-item-wrap cont relative">
											<?php $widget_7_small_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-widget-7-small'); if ($widget_7_small_thumbnail) { ?>
											<img src="<?php echo esc_url($widget_7_small_thumbnail[0]); ?>" alt="<?php get_the_title() ? the_title() : the_ID(); ?>">
											<?php } ?>
											<div class="space-overlay absolute"></div>
											<div class="space-overlay-gradient absolute"></div>
											<div class="space-widget-7-date-small-wrap absolute">
												<div class="space-widget-7-date space-common-meta relative">
													<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?>
												</div>
											</div>
											<div class="space-widget-7-small-title absolute">
												<span class="space-widget-7-small-category"><?php if ($categories) { ?><?php echo esc_html(get_cat_name( $categories )) ?><?php } else { ?><?php esc_html_e( 'Latest News', 'ceres' ); ?><?php } ?></span> <?php get_the_title() ? the_title() : the_ID(); ?>
											</div>
										</div>
									</div>
								</a>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>

		<?php
		wp_reset_postdata();
		endif;
	}

/*  Update Ceres Widget #7  */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['cats_id'] = (int) $new_instance['cats_id'];
		return $instance;
	}

/*  Ceres Widget #7 Settings Form  */

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
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

<?php

	}
}

add_action( 'widgets_init', 'ceres_widget_7' );

function ceres_widget_7() {
	register_widget( 'ceres_widget_7' );
}