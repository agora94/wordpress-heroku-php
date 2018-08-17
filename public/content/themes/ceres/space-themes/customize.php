<?php

/*  Customize Settings Start  */

function ceres_custom_logo_setup() {
    $defaults = array(
        'height'      => 36,
        'width'       => 133,
        'flex-height' => true,
		'flex-width'  => true,
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'ceres_custom_logo_setup' );

 function ceres_categories_select() {
	  $cats = array();
	  $cats[0] = esc_html__( 'All', 'ceres' );
	  foreach ( get_categories() as $categories => $category ) {
	    $cats[$category->term_id] = $category->name;
	  }
	  return $cats;
}

function ceres_sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function ceres_sanitize_select( $input, $setting ) {
	
	$input = sanitize_key( $input );

	$choices = $setting->manager->get_control( $setting->id )->choices;

	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function ceres_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

function ceres_customizer_setting($wp_customize) {

    /*  Footer Logo  */

    $wp_customize->add_setting('ceres_footer_logo', array(
        'sanitize_callback' => 'esc_url_raw',
        'capability' =>  'edit_theme_options'
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ceres_footer_logo', array(
        'label' => esc_html__( 'Footer Logo', 'ceres' ),
        'section' => 'title_tagline',
        'settings' => 'ceres_footer_logo',
        'priority' => 8
    )));


    /*  Retina Footer Logo  */

    $wp_customize->add_setting('ceres_retina_footer_logo', array(
        'sanitize_callback' => 'esc_url_raw',
        'capability' =>  'edit_theme_options'
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ceres_retina_footer_logo', array(
        'label' => esc_html__( 'Retina Footer Logo', 'ceres' ),
        'description' => esc_html__( 'High-resolution 2x footer logo.', 'ceres' ),
        'section' => 'title_tagline',
        'settings' => 'ceres_retina_footer_logo',
        'priority' => 8
    )));


    /*  Main Color  */

    $wp_customize->add_setting( 'main_color', array(
		'default' => '#ffc107',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' =>  'edit_theme_options'
	) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
	    'label'   => esc_html__( 'Main Color', 'ceres' ),
	    'section' => 'colors',
	    'settings'   => 'main_color'
	)));


    /*  Footer Copyright  */

    $wp_customize->add_setting( 'footer_copyright', array(
	  'capability' => 'edit_theme_options',
	  'default' => '',
	  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'footer_copyright', array(
	  'type' => 'textarea',
	  'section' => 'title_tagline',
	  'label' => esc_html__( 'Footer Copyright', 'ceres' ),
	  'description' => esc_html__( 'Add your copyright to the footer.', 'ceres' ),
	) );


	/*  Posts Settings  */

	$wp_customize->add_section( 'ceres_posts_settings' , array(
	    'title'      => esc_html__( 'Posts', 'ceres' ),
	    'priority'   => 130,
	) );

	/*  --- Related posts ---  */

	$wp_customize->add_setting( 'ceres_related_posts', array(
		'default' => false,
		'sanitize_callback' => 'ceres_sanitize_checkbox',
		'capability' =>  'edit_theme_options'
	 ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ceres_related_posts', array(
		'label' => esc_html__( 'Enable related posts', 'ceres' ),
	    'section'  => 'ceres_posts_settings',
	    'settings' => 'ceres_related_posts',
	    'type'     => 'checkbox'
	)));

	/*  --- Sticky sidebar ---  */

	$wp_customize->add_setting( 'ceres_sticky-sidebar', array(
		'default' => false,
		'sanitize_callback' => 'ceres_sanitize_checkbox',
		'capability' =>  'edit_theme_options'
	 ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ceres_sticky-sidebar', array(
		'label' => esc_html__( 'Enable sticky sidebar', 'ceres' ),
	    'section'  => 'ceres_posts_settings',
	    'settings' => 'ceres_sticky-sidebar',
	    'type'     => 'checkbox'
	)));


	/*  Social Icons Section  */

	$wp_customize->add_section( 'ceres_social_icons' , array(
	    'title'      => esc_html__( 'Social Icons', 'ceres' ),
	    'priority'   => 150,
	) );

	/*  --- Facebook ---  */

	$wp_customize->add_setting( 'ceres_facebook_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_facebook_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'Facebook', 'ceres' ),
		'input_attrs' => array(
		    'placeholder' => esc_html__( 'https://www.facebook.com/spacethemescom/', 'ceres' ),
		),
	));

	/*  --- Twitter ---  */

	$wp_customize->add_setting( 'ceres_twitter_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_twitter_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'Twitter', 'ceres' ),
		'input_attrs' => array(
		    'placeholder' => esc_html__( 'https://twitter.com/space_themes', 'ceres' ),
		),
	));

	/*  --- YouTube ---  */

	$wp_customize->add_setting( 'ceres_youtube_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_youtube_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'YouTube', 'ceres' ),
		'input_attrs' => array(
		    'placeholder' => esc_html__( 'https://www.youtube.com/channel/UCMlQIh6VY2JbgABJiWU3LJQ', 'ceres' ),
		),
	));

	/*  --- Instagram ---  */

	$wp_customize->add_setting( 'ceres_instagram_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_instagram_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'Instagram', 'ceres' ),
	));

	/*  --- Google+ ---  */

	$wp_customize->add_setting( 'ceres_google_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_google_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'Google+', 'ceres' ),
	));

	/*  --- LinkedIn ---  */

	$wp_customize->add_setting( 'ceres_linkedin_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_linkedin_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'LinkedIn', 'ceres' ),
	));

	/*  --- Telegram ---  */

	$wp_customize->add_setting( 'ceres_telegram_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_telegram_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'Telegram', 'ceres' ),
	));

	/*  --- Reddit ---  */

	$wp_customize->add_setting( 'ceres_reddit_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_reddit_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'Reddit', 'ceres' ),
	));

	/*  --- VK ---  */

	$wp_customize->add_setting( 'ceres_vk_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_vk_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'VK', 'ceres' ),
	));

	/*  --- Other Link ---  */

	$wp_customize->add_setting( 'ceres_other_link_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'ceres_sanitize_url',
	));

	$wp_customize->add_control( 'ceres_other_link_url', array(
		'type' => 'url',
		'section' => 'ceres_social_icons',
		'label' => esc_html__( 'Other Link', 'ceres' ),
	));

}

add_action('customize_register', 'ceres_customizer_setting');

/*  Customize Settings End  */