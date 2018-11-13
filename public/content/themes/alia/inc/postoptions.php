<?php
add_action("admin_init", "alia_post_metaboxes");

function alia_post_metaboxes() {
    $global_types = array('post','page');

    // add meta boxes to posts.
    add_meta_box("alia_post_options", sprintf(__('%s - Post Options.', 'alia'), theme_name), "alia_posts_meta_options", "post", "normal", "core");

    // add meta boxes to pages.
    add_meta_box("alia_page_options", sprintf(__('%s - Page Options.', 'alia'), theme_name), "alia_page_options", "page", "normal", "core");

}

function alia_post_options($value, $validation = "") {
    global $post;

    $depends_on_templates = "";
    if (isset($value['templates']) && $value['templates'] != "" ) {

        $mother_templates_atts = '';
        foreach($value['templates'] as $template) {
            $mother_templates_atts .= 'page-templates/'.$template.'.php ';
        }
        $depends_on_templates = ' data_mother_templates="'.$mother_templates_atts.'"';
    }
    ?>

    <div class="option-item alia_post_option_item" id="<?php echo esc_attr($value['id']) ?>-item" <?php echo esc_attr($depends_on_templates); ?> >
        <span class="label"><?php echo esc_attr($value['name']); ?></span>
        <?php
        $id = esc_attr($value['id']);
        $get_meta = get_post_custom($post->ID);
        $current_value = "";
        if (isset($value['default']) && $value['default']) {
        	$current_value = $value['default'];
        }
        if (isset($get_meta[$id][0])) {
            if($validation == 'url') {
                $current_value = esc_url($get_meta[$id][0]);
            }elseif($validation == 'attr') {
                $current_value = esc_attr($get_meta[$id][0]);
            }else{
                $current_value = $get_meta[$id][0];
            }
        }

        switch ($value['type']) {

            case 'select':
                ?>
                <select name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>">
                    <?php foreach ($value['options'] as $key => $option) { ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php
                        if ($current_value == $key) {
                            echo ' selected="selected"';
                        }
                        ?>><?php echo esc_attr($option); ?></option>
                            <?php } ?>
                </select>
                <?php
                break;
        }
        ?>
    </div>
    <?php
}


function alia_page_options() {

    global $alia_data;

    alia_post_options(
            array("name" => __("Page Layout", 'alia'),
                "id" => "alia_page_layout",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'alia'),
                    'fullwidth' => __('Full Width', 'alia'),
                    'sidebar_l' => __('Sidebar Post', 'alia')
    )));

    wp_nonce_field( basename( __FILE__ ), 'alia_page_options' );

}

add_action('save_post', 'save_page_options');
function save_page_options() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['alia_page_options'] ) || !wp_verify_nonce( $_POST['alia_page_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

        $custom_meta_fields = array(
          'alia_page_layout',
        );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}

function alia_posts_meta_options() {
    global $alia_data;

    alia_post_options(
            array("name" => __("Post Layout", 'alia'),
                "id" => "alia_post_layout",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'alia'),
                    'fullwidth' => __('Full Width', 'alia'),
                    'sidebar_l' => __('Sidebar Post', 'alia')
    )));

    wp_nonce_field( basename( __FILE__ ), 'alia_posts_meta_options' );
}

add_action('save_post', 'alia_save_post');

function alia_save_post() {
    global $post;

    if ( isset($post) ) : // check if post is exists
    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['alia_posts_meta_options'] ) || !wp_verify_nonce( $_POST['alia_posts_meta_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
      'alia_post_layout',
    );
    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }
    endif; // end if check if post is exists
}
?>