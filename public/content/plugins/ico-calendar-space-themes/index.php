<?php
/*
Plugin Name: ICO Calendar Space-Themes
Plugin URI: https://space-themes.com/item/ceres/
Description: ICO Calendar Plugin for Ceres Theme.
Version: 1.0.1
Author: Space-Themes.com
Author URI: https://space-themes.com/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: spacethemesico
*/

add_action('init', 'spacethemes_ico', 0 );
    function spacethemes_ico() {

            $args = array(
                    'labels' => array(
							'name' => esc_html__('ICO Calendar', 'spacethemesico'),
							'add_new' => esc_html__('Add Company', 'spacethemesico'),
                            'edit_item' => esc_html__('Edit Company', 'spacethemesico'),
                            'add_new_item' => esc_html__('Add New Company', 'spacethemesico'),
                            'view_item' => esc_html__('View Company', 'spacethemesico'),
                    ),
                    'singular_label' => __('ico'),
                    'public' => true,
					'publicly_queryable' => true,
                    'show_ui' => true,
					'show_in_rest' => true,
					'menu_icon' => plugins_url( 'ico-calendar-space-themes/images/icon.png' ),
                    '_builtin' => false,
                    '_edit_link' => 'post.php?post=%d',
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    'supports' => array('title', 'editor', 'comments', 'thumbnail', 'excerpt'),
					'has_archive' => true,
					'rewrite' => array(
					'slug' => 'ico',
					'with_front' => false
					)
            );

            register_post_type( 'ico' , $args );
			
	$labels = array(
	'name' => esc_html__('Categories', 'spacethemesico')
	,'singular_name' => esc_html__('Category', 'spacethemesico')
	,'search_items' => esc_html__('Find Category', 'spacethemesico')
	,'all_items' => esc_html__('All Categories', 'spacethemesico')
	,'parent_item' => esc_html__('Parent Category', 'spacethemesico')
	,'parent_item_colon' => esc_html__('Parent Category:', 'spacethemesico')
	,'edit_item' => esc_html__('Edit Category', 'spacethemesico')
	,'update_item' => esc_html__('Update Category', 'spacethemesico')
	,'add_new_item' => esc_html__('Add New Category', 'spacethemesico')
	,'new_item_name' => esc_html__('Category', 'spacethemesico')
	,'menu_name' => esc_html__('Categories', 'spacethemesico')
	); 

	$args = array(
	'labels' => $labels
	,'public' => true
	,'show_in_nav_menus' => true
	,'show_ui' => true
	,'show_tagcloud' => true
	,'hierarchical' => true
	,'update_count_callback' => ''
	,'rewrite' => true
	,'query_var' => ''
	,'capabilities' => array()
	,'_builtin' => false
	);
	
	register_taxonomy('stcategory', 'ico', $args);

}

add_action( 'admin_init', 'spacethemes_ico_fields' );

function spacethemes_ico_fields() {
    add_meta_box( 'spacethemes_ico_meta_box',
        __( 'ICO Information', 'spacethemesico' ),
        'spacethemes_ico_display_meta_box',
        'ico', 'normal', 'high'
    );
}

function spacethemes_ico_display_meta_box( $ico ) {
	wp_nonce_field( 'spacethemes_ico_box', 'spacethemes_ico_nonce' );
	$start_date = get_post_meta( $ico->ID, 'start_date', true );
	$end_date = get_post_meta( $ico->ID, 'end_date', true );
	$short_description = get_post_meta( $ico->ID, 'short_description', true );
	$website_address = get_post_meta( $ico->ID, 'website_address', true );
    ?>
	
<table style="width:100%;">	
<tbody>
<tr>
<td style="width:50%;">
<p>
<label for="start_date"><strong><?php esc_html_e( 'Start date', 'spacethemesico' )?></strong></label><br />
<input type="date" name="start_date" value="<?php echo $start_date; ?>" style="width:98%;" />
</p>
</td>
<td style="width:50%;">
<p>
<label for="end_date"><strong><?php esc_html_e( 'End date', 'spacethemesico' )?></strong></label><br />
<input type="date" name="end_date" value="<?php echo $end_date; ?>" style="width:98%;" />
</p>
</td>
</tr>
<tr>
<td style="width:50%;">
<p>
<label for="short_description"><strong><?php esc_html_e( 'Short description', 'spacethemesico' )?></strong></label><br />
<input type="text" name="short_description" value="<?php echo $short_description; ?>" style="width:98%;" />
</p>
</td>
<td style="width:50%;">
<p>
<label for="website_address"><strong><?php esc_html_e( 'Website address', 'spacethemesico' )?></strong></label><br />
<input type="text" name="website_address" value="<?php echo $website_address; ?>" placeholder="<?php esc_attr( 'www.ceres.co', 'spacethemesico' )?>" style="width:98%;" />
</p>
</td>
</tr>
</tbody>
</table>		

    <?php
}

add_action( 'save_post', 'spacethemes_ico_save_fields', 10, 2 );

function spacethemes_ico_save_fields( $post_id ) {
		if ( ! isset( $_POST['spacethemes_ico_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['spacethemes_ico_nonce'];

        if ( ! wp_verify_nonce( $nonce, 'spacethemes_ico_box' ) ) {
            return $post_id;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( 'ico' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        }
		
		$start_date = sanitize_text_field( $_POST['start_date'] );
        update_post_meta( $post_id, 'start_date', $start_date );
		
		$end_date = sanitize_text_field( $_POST['end_date'] );
        update_post_meta( $post_id, 'end_date', $end_date );
		
		$short_description = sanitize_text_field( $_POST['short_description'] );
        update_post_meta( $post_id, 'short_description', $short_description );
		
		$website_address = sanitize_text_field( $_POST['website_address'] );
        update_post_meta( $post_id, 'website_address', $website_address );	
}

/*  ICO Calendar Widget  */

class spacethemes_ico_sidebar_widget extends WP_Widget {

/*  ICO Calendar Widget Setup  */

	function spacethemes_ico_sidebar_widget() {
		parent::__construct(false, $name = esc_html__('ICO Calendar Widget', 'spacethemesico' ), array(
			'description' => esc_html__('Latest ICO for display in Sidebar', 'spacethemesico' )
		));
	}

/*  Display ICO Calendar Widget  */

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'ICO Calendar', 'spacethemesico' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$categories = isset( $instance['term_taxonomy_id'] ) ? $instance['term_taxonomy_id'] : '';
		if ( ! empty( $categories ) ) {
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'post_type' => 'ico',
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'stcategory',
					'field'    => 'id',
					'terms'    => $categories
				)
			)
		) ) );
		} else {
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'post_type' => 'ico',
			'no_found_rows'       => true,
			'post_status'         => 'publish'
		) ) );
		}

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="space-widget-ico-calendar relative">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		
		<?php
			global $post; 
			$start_date = esc_html( get_post_meta( get_the_ID(), 'start_date', true ) );
			$short_description = esc_html( get_post_meta( get_the_ID(), 'short_description', true ) );
		?>
		
								<div class="space-widget-ico-calendar-item relative">
									<div class="space-widget-ico-calendar-item-ins relative">
										<span class="right"><?php echo date('M d, Y',strtotime($start_date)); ?></span>
										<?php $ico_logo = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-ico-calendar-1'); if ($ico_logo) { ?>
										<a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>"><img src="<?php echo esc_url($ico_logo[0]); ?>" alt=""></a>
										<?php } else { } ?>
										<div class="space-widget-ico-calendar-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title() ? the_title() : the_ID(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></div>
										<?php if ($short_description) { ?>
										<div class="space-widget-ico-calendar-desc"><?php echo $short_description; ?></div>
										<?php } ?>
									</div>
								</div>

		<?php endwhile; ?>
		</div>
		<?php echo $args['after_widget']; ?>
		<?php

		wp_reset_postdata();

		endif;
	}

/*  Update ICO Calendar Widget  */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['term_taxonomy_id'] = (int) $new_instance['term_taxonomy_id'];
		return $instance;
	}

/*  ICO Calendar Settings Form  */

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$args = array(
			'type'         => 'ico',
			'orderby'      => 'name',
			'hide_empty'   => 1,
			'taxonomy'     => 'stcategory'
		);
		$cats = get_categories($args);
		$categories = isset( $instance['term_taxonomy_id'] ) ? $instance['term_taxonomy_id'] : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'spacethemesico' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of ICO to show:', 'spacethemesico' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'term_taxonomy_id' ); ?>"><?php esc_html_e('Select Category:' , 'spacethemesico' );?></label>
		<select id="<?php echo $this->get_field_id( 'term_taxonomy_id' ); ?>" name="<?php echo $this->get_field_name( 'term_taxonomy_id' ); ?>">
 		<option value=""><?php esc_html_e('All' , 'spacethemesico' );?></option>
			<?php foreach ( $cats as $cat ) {?>
			<option value="<?php echo $cat->term_id ?>"<?php echo selected( $categories, $cat->term_id, false ) ?>> <?php echo esc_html( $cat->name ) ?></option>
			<?php }?>
 		</select></p>
<?php
	}
}

add_action( 'widgets_init', 'spacethemes_ico_sidebar_widget' );

function spacethemes_ico_sidebar_widget() {
	register_widget( 'spacethemes_ico_sidebar_widget' );
}

?>