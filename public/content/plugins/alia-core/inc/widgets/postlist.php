<?php
add_action('widgets_init', 'postlist_widget_init');

function postlist_widget_init() {
    register_widget('postlist_widget');
}

class postlist_widget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'postlist-widget', // Base ID
			theme_name . ' - ' . __('Post List', 'alia-core'), // Name
			array( 'classname' => 'alia-postlist-widget', 'description' => '', 'width' => 250, 'height' => 350 ) // Args
		);
	}

    function widget($args, $instance) {
        extract($args);


        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : '' ;
        $number = isset( $instance['number'] ) ? esc_attr($instance['number']) : '4' ;
        $order = isset( $instance['order'] ) ? esc_attr($instance['order']) : 'date' ;
        $category = isset( $instance['category'] ) ? esc_attr($instance['category']) : '' ;
        $tags = isset( $instance['tags'] ) ? esc_attr($instance['tags']) : '' ;

        echo $before_widget;

        if ($title) :
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;
        ?>
        <?php
        echo '<div class="alia_post_list_widget">';
        echo alia_return_blogposts_list($number, array(60, 60), $order, $category, $tags);
        echo '</div>';
        ?>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['order'] = $new_instance['order'];
        $instance['category'] = $new_instance['category'];
        $instance['tags'] = $new_instance['tags'];
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Post List', 'alia-core'), 'number' => '3', 'order' => 'date', 'tags' => '', 'category' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'alia-core'); ?>: </label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number Of Posts', 'alia-core'); ?>: </label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" type="text" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Post Order', 'alia-core'); ?>: </label>
            <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" >
                <option value="date" <?php if ($instance['order'] == 'date') echo "selected=\"selected\"";
        else echo ""; ?>><?php _e('Date', 'alia-core'); ?></option>
                <option value="comment_count" <?php if ($instance['order'] == 'comment_count') echo "selected=\"selected\"";
        else echo ""; ?>><?php _e('Comment Count', 'alia-core'); ?></option>
        <?php if (alia_cross_option('alia_hits_counter') != 'no') { ?>
                <option value="most_views" <?php if ($instance['order'] == 'most_views') echo "selected=\"selected\"";
        else echo ""; ?>><?php _e('Views Count', 'alia-core'); ?></option>
        <?php } ?>
                <option value="rand" <?php if ($instance['order'] == 'rand') echo "selected=\"selected\"";
        else echo ""; ?>><?php _e('Random', 'alia-core'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category', 'alia-core'); ?>: </label>
            <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" >
              <option value="" <?php if ($instance['category'] == '') echo "selected=\"selected\"";
      else echo ""; ?>><?php _e('All Categories', 'alia-core'); ?></option>
                <?php $cats = get_categories(); ?>
                <?php foreach ($cats as $cat) { ?>
                  <option value="<?php echo $cat->slug;?>" <?php if ($instance['category'] == $cat->slug) echo "selected=\"selected\""; else echo "";?>><?php echo $cat->name; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags', 'alia-core'); ?>: </label>
            <input id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" value="<?php echo $instance['tags']; ?>" class="widefat" type="text" />
        </p>
        <?php
    }

}
?>