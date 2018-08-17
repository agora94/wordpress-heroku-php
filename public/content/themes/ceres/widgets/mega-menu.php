<?php

class ceres_recent_posts_mega_menu_widget extends WP_Widget {

/*  Ceres Recent Posts Mega Menu Widget Setup  */

	function ceres_recent_posts_mega_menu_widget() {
		parent::__construct(false, $name = esc_html__('Ceres Mega Menu Recent Posts', 'ceres' ), array(
			'description' => esc_html__('Recent Posts for Mega Menu', 'ceres' )
		));
	}

/*  Display Ceres Recent Posts Mega Menu Widget  */

	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$categories = isset( $instance['cats_id'] ) ? $instance['cats_id'] : '';
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(

			'posts_per_page'      => $number,
			'cat'      => $categories,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true

		) ) );

		if ($r->have_posts()) :
		?>

		<?php echo $args['before_widget']; ?>

		<div class="space-mega-menu-wrap-ins cont relative">

		<?php while ( $r->have_posts() ) : $r->the_post(); ?>

			<div class="space-mega-menu-post left relative">
				<div class="space-mega-menu-post-ins relative">
					<?php $src_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-widget-mega-menu'); if ($src_thumbnail) { ?>
					<div class="mega-menu-post-img relative">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>"><img src="<?php echo esc_url($src_thumbnail[0]); ?>" alt="<?php get_the_title() ? the_title() : the_ID(); ?>" /></a>
					</div>
					<?php } else {} ?>
					<div class="mega-menu-post-title relative">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
					</div>
					<div class="mega-menu-post-meta space-common-meta relative">
						<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?> <span><i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

		</div>

		<?php echo $args['after_widget']; ?>
		<?php
			wp_reset_postdata();
			endif;
	}

/*  Update Ceres Recent Posts Mega Menu Widget  */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['number'] = (int) $new_instance['number'];
		$instance['cats_id'] = (int) $new_instance['cats_id'];
		return $instance;
	}

/*  Ceres Recent Posts Mega Menu Widget Settings Form  */

	public function form( $instance ) {
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		$cats = get_categories();
		$categories = isset( $instance['cats_id'] ) ? $instance['cats_id'] : '';
?>

		<p><label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php echo esc_html__('Select Category:' , 'ceres' );?></label>
		<select id="<?php echo $this->get_field_id( 'cats_id' ); ?>" name="<?php echo $this->get_field_name( 'cats_id' ); ?>">
 		<option value=""><?php echo esc_html__('All' , 'ceres' );?></option>
			<?php foreach ( $cats as $cat ) {?>
			<option value="<?php echo $cat->term_id ?>"<?php echo selected( $categories, $cat->term_id, false ) ?>> <?php echo esc_html( $cat->name ) ?></option>
			<?php }?>
 		</select></p>

<?php
	}
}

add_action( 'widgets_init', 'ceres_recent_posts_mega_menu_widget' );

function ceres_recent_posts_mega_menu_widget() {
	register_widget( 'ceres_recent_posts_mega_menu_widget' );
}