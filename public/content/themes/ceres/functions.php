<?php

add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );

function ceres_comments_reply() {
	if( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'ceres_comments_reply' );

function ceres_remove_caption_extra_width($width) {
   return $width - 10;
}
add_filter('img_caption_shortcode_width', 'ceres_remove_caption_extra_width');

/*  Content Width Start  */

function ceres_content_width() {

	$content_width = 1024;
	$GLOBALS['content_width'] = apply_filters( 'ceres_content_width', $content_width );
}
add_action( 'after_setup_theme', 'ceres_content_width', 0 );

/*  Content Width End  */

/*  Pingback Start  */

function ceres_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'ceres_pingback_header' );

/*  Pingback End  */

/*  Navigation Markup Template Start  */

add_filter('navigation_markup_template', 'ceres_navigation_template', 10, 2 );
			function ceres_navigation_template( $template, $class ){
			return '
			<div class="space-archive-navigation cont relative">
				<nav class="navigation %1$s">
					<div class="nav-links">%3$s</div>
				</nav>
			</div>
			';
}

/*  Navigation Markup Template End  */

/*  Menus, Languages and Thumbnails Start  */

function ceres_setup() {
	
	load_theme_textdomain( 'ceres', get_template_directory() . '/languages' );
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'ceres-custom-logo', 9999, 36);
	add_image_size( 'ceres-footer-logo', 185, 50, true );
	add_image_size( 'ceres-archive-loop-img', 316, 316, true );
	add_image_size( 'ceres-single-img-1', 1024, 576, true );
	add_image_size( 'ceres-single-img-2', 1200, 576, true );
	add_image_size( 'ceres-single-img-3', 600, 338, true );
	add_image_size( 'ceres-widget-mega-menu', 204, 115, true );
	add_image_size( 'ceres-widget-1', 663, 554, true );
	add_image_size( 'ceres-widget-3', 390, 219, true );
	add_image_size( 'ceres-widget-4', 482, 271, true );
	add_image_size( 'ceres-widget-5', 420, 236, true );
	add_image_size( 'ceres-widget-6', 450, 800, true );
	add_image_size( 'ceres-widget-7-big', 653, 498, true );
	add_image_size( 'ceres-widget-7-small', 420, 315, true );
	add_image_size( 'ceres-ico-calendar-1', 40, 40, true );
	add_image_size( 'ceres-ico-calendar-2', 200, 200, true );
	add_image_size( 'ceres-ico-calendar-3', 100, 100, true );
	
	register_nav_menus( array(
		'main-menu'   => esc_html__( 'Main Menu', 'ceres' ),
		'footer-menu'   => esc_html__( 'Footer Menu', 'ceres' ),
	) );
	
}
add_action( 'after_setup_theme', 'ceres_setup' );

/*  Menus, Languages and Thumbnails End  */

/*  Widgets Setup Start  */

function ceres_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ceres' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'ceres' ),
		'before_widget' => '<div id="%1$s" class="space-widget-default cont relative widget %2$s">
					<div class="space-widget-default-wrap white-15 relative">
						<div class="space-widget-default-ins relative">',
		'after_widget'  => '</div>
					</div>
				</div>',
		'before_title'  => '<div class="space-widget-default-title relative">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Central Box', 'ceres' ),
		'id'            => 'homepage-central-box',
		'description'   => esc_html__( 'For central box widgets.', 'ceres' ),
		'before_widget' => '<div id="%1$s" class="space-widget-default cont relative widget %2$s">
					<div class="space-widget-default-wrap white-15 relative">
						<div class="space-widget-default-ins relative">',
		'after_widget'  => '</div>
					</div>
				</div>',
		'before_title'  => '<div class="space-widget-default-title relative">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Small Box', 'ceres' ),
		'id'            => 'homepage-small-box',
		'description'   => esc_html__( 'For small box widgets.', 'ceres' ),
		'before_widget' => '<div id="%1$s" class="space-widget-default cont relative widget %2$s">
					<div class="space-widget-default-wrap white-15 relative">
						<div class="space-widget-default-ins relative">',
		'after_widget'  => '</div>
					</div>
				</div>',
		'before_title'  => '<div class="space-widget-default-title relative">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'ceres' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'For shop sidebar widgets.', 'ceres' ),
		'before_widget' => '<div id="%1$s" class="space-widget-default cont relative widget %2$s">
					<div class="space-widget-default-wrap white-15 relative">
						<div class="space-widget-default-ins relative">',
		'after_widget'  => '</div>
					</div>
				</div>',
		'before_title'  => '<div class="space-widget-default-title relative">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'ceres_widgets_init' );

function ceres_widgets_mega_menu_init() {
    $location = 'main-menu';
    $css_class = 'has-mega-menu';
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
        $menu = get_term( $locations[ $location ], 'nav_menu' );
        if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
            foreach ( $items as $item ) {
                if ( in_array( $css_class, $item->classes ) ) {
                    register_sidebar( array(
                        'id'   => 'mega-menu-widget-area-' . $item->ID,
                        'name' => $item->title . ' - Mega Menu',
						'description'   => esc_html__( 'Only for Mega Menu item.', 'ceres' ),
						'before_widget' => '<div id="%1$s" class="%2$s">',
						'after_widget'  => '</div>',
                    ) );
                }
            }
        }
    }
}
add_action( 'widgets_init', 'ceres_widgets_mega_menu_init' );

require_once( get_template_directory() . '/space-themes/mega-menu.php' );

/*  Widgets Setup End  */

/*  Header Style for Single Posts Start */

function ceres_register_header_style() {
    add_meta_box( 'meta-box-id', esc_html__( 'Post template style', 'ceres' ), 'ceres_header_style_callback', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'ceres_register_header_style' );

function ceres_header_style_callback( $post ) {
	wp_nonce_field( 'header_style_box', 'header_style_nonce' );
    $header_style = get_post_meta( $post->ID, 'header_style', true );
?>
    <?php $selected = ' selected'; ?>
    <select id="header_style" name="header_style" style="width:100%;">
     <option value="1"<?php if ( $header_style == '1') echo esc_html( $selected ); ?>><?php esc_html_e( 'Style 1', 'ceres' ); ?></option>
     <option value="2"<?php if ( $header_style == '2') echo esc_html( $selected ); ?>><?php esc_html_e( 'Style 2 (Full Width)', 'ceres' ); ?></option>
     <option value="3"<?php if ( $header_style == '3') echo esc_html( $selected ); ?>><?php esc_html_e( 'Style 3', 'ceres' ); ?></option>
     <option value="4"<?php if ( $header_style == '4') echo esc_html( $selected ); ?>><?php esc_html_e( 'Style 4 (Full Width)', 'ceres' ); ?></option>
     <option value="5"<?php if ( $header_style == '5') echo esc_html( $selected ); ?>><?php esc_html_e( 'Style 5', 'ceres' ); ?></option>
     <option value="6"<?php if ( $header_style == '6') echo esc_html( $selected ); ?>><?php esc_html_e( 'Style 6 (Full Width)', 'ceres' ); ?></option>
    </select>
<?php
}

function ceres_header_style_save( $post_id ) {

        if ( ! isset( $_POST['header_style_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['header_style_nonce'];

        if ( ! wp_verify_nonce( $nonce, 'header_style_box' ) ) {
            return $post_id;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        $header_style_data = sanitize_text_field( $_POST['header_style'] );

        update_post_meta( $post_id, 'header_style', $header_style_data );
}
add_action( 'save_post', 'ceres_header_style_save' );

/*  Header Style for Single Posts End */

/*  Mobile Browser Bar Color Start  */

function ceres_header_bar_color() {
?>
<meta name="theme-color" content="#263238" />
<meta name="msapplication-navbutton-color" content="#263238" /> 
<meta name="apple-mobile-web-app-status-bar-style" content="#263238" />
<?php }

add_action('wp_head', 'ceres_header_bar_color');

/*  Mobile Browser Bar Color End  */

/*  Register Fonts Start  */

function ceres_google_fonts() {
    $font_url = '';

    if ( 'off' !== _x( 'on', 'Google font: on or off', 'ceres' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Heebo:300,400,500,700|Open+Sans:300,400,700' ), "//fonts.googleapis.com/css" );
    }

    return $font_url;
}

function ceres_fonts() {
    wp_enqueue_style( 'ceres-fonts', ceres_google_fonts(), array(), '1.1.0' );
}
add_action( 'wp_enqueue_scripts', 'ceres_fonts' );

/*  Register Fonts End  */

/*  Register Scripts & Colors Start  */

function ceres_scripts() {
	
	if( get_theme_mod('ceres_sticky-sidebar') ) {
		wp_enqueue_script( 'theia-sticky-sidebar', get_theme_file_uri( '/js/theia-sticky-sidebar.min.js' ), array( 'jquery' ), '1.7.0', true );
		wp_enqueue_script( 'ceres-enable-sticky-sidebar-js', get_theme_file_uri( '/js/enable-sticky-sidebar.js' ), array( 'jquery' ), '1.1.2', true );
	}
	wp_enqueue_script( 'ceres-global-js', get_theme_file_uri( '/js/scripts.js' ), array( 'jquery' ), '1.1.2', true );
	wp_enqueue_script( 'retina', get_theme_file_uri( '/js/retina.min.js' ), array( 'jquery' ), '1.3.0', true );

	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/css/font-awesome.min.css' ), array(), '4.7.0');
	wp_enqueue_style( 'ceres-style', get_stylesheet_uri(), array(), '1.1.2');
	wp_enqueue_style( 'ceres-media', get_theme_file_uri( '/css/media.css' ), array(), '1.1.2');
	
	global $ceres_data; 
			
			// Custom Color
			
			if( !$main_custom_color = get_theme_mod( 'main_color' ) ) {
				$main_custom_color = '#ffc107';
			} else {
				$main_custom_color = get_theme_mod( 'main_color' );
			}
			
			$custom_css = '

			input[type="submit"],
			.space-widget-3-second-news ul li:after,
			.space-widget-3-second-news ul li:hover:after,
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce #respond input#submit.alt,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce input.button.alt,
			form.woocommerce-product-search button[type="submit"] {
				background-color: ' . esc_attr ($main_custom_color) . ';
			}

			blockquote,
			.space-title-frame,
			nav.pagination a,
			nav.comments-pagination a,
			nav.pagination-post a span.page-number,
			.space-widget-7-big-cat span,
			#scrolltop,
			.woocommerce nav.woocommerce-pagination ul li a,
			.woocommerce nav.woocommerce-pagination ul li span {
				border: 2px solid ' . esc_attr ($main_custom_color) . ';
			}

			.space-widget-2-title span.space-widget-2-category a,
			.space-widget-7-small-title span.space-widget-7-small-category,
			.box-25 .space-widget-7-big-cat span,
			.woocommerce span.onsale {
				border: 1px solid ' . esc_attr ($main_custom_color) . ';
			}

			.space-widget-default-title,
			.space-read-more-wrap,
			.space-read-more-wrap a,
			.space-widget-3-box-title,
			.woocommerce-MyAccount-content .woocommerce-EditAccountForm legend {
				border-bottom: 1px solid ' . esc_attr ($main_custom_color) . ';
			}

			.space-archive-loop-category,
			.space-archive-loop-category a,
			.space-single-page-category,
			.space-single-page-category a,
			.space-comments-list-item-date a.comment-reply-link,
			.space-comments-form-box p.comment-notes span.required,
			.space-widget-1-category,
			.space-widget-1-category a,
			.space-widget-4-category,
			.space-widget-4-category a,
			.space-widget-4-meta i,
			.space-widget-5-category,
			.space-widget-5-category a,
			.space-widget-6-category,
			.space-widget-6-category a,
			.space-widget-7-date i,
			.space-widget-7-small-title span.space-widget-7-small-category,
			#scrolltop,
			.space-ccpw-ins .ccpw_table thead th:nth-child(2),
			.ccpw_table .price-value,
			.woocommerce ul.products li.product .price,
			.woocommerce div.product p.price,
			.woocommerce div.product span.price,
			.woocommerce form .form-row .required,
			.home-page .box-75 .woocommerce ul.product_list_widget li span.woocommerce-Price-amount {
				color: ' . esc_attr ($main_custom_color) . ' !important;
			}';

	$custom_css .= esc_attr($ceres_data['custom_css']);

	wp_add_inline_style( 'ceres-style', $custom_css );
	
}
add_action( 'wp_enqueue_scripts', 'ceres_scripts' );

/*  Register Scripts & Colors End  */

/*  Space-Themes Functions Start  */

require_once( get_template_directory() . '/space-themes/breadcrumbs.php' );
require_once( get_template_directory() . '/space-themes/retina.php' );
require_once( get_template_directory() . '/space-themes/postviews-count.php' );
require_once( get_template_directory() . '/space-themes/custom-comments.php' );
require_once( get_template_directory() . '/space-themes/customize.php' );
require_once( get_template_directory() . '/space-themes/importer.php' );
require_once( get_template_directory() . '/space-themes/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/space-themes/woocommerce.php' );

/*  Space-Themes Functions End  */

/*  Ceres Widgets Start */

require_once( get_template_directory() . '/widgets/widget-1.php' );
require_once( get_template_directory() . '/widgets/widget-2.php' );
require_once( get_template_directory() . '/widgets/widget-3.php' );
require_once( get_template_directory() . '/widgets/widget-4.php' );
require_once( get_template_directory() . '/widgets/widget-5.php' );
require_once( get_template_directory() . '/widgets/widget-6.php' );
require_once( get_template_directory() . '/widgets/widget-7.php' );
require_once( get_template_directory() . '/widgets/mega-menu.php' );
require_once( get_template_directory() . '/widgets/static-banner.php' );
require_once( get_template_directory() . '/widgets/ceres-ccpw.php' );

/*  Ceres Widgets End */

/*  Ceres Register Required Plugins Start */

add_action( 'tgmpa_register', 'ceres_register_required_plugins' );

function ceres_register_required_plugins() {

	$plugins = array(

		array(
			'name'     				=> esc_html__('One Click Demo Import', 'ceres'),
			'slug'     				=> 'one-click-demo-import',
			'required' 				=> true,
			'version' 				=> '2.5.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('Cryptocurrency Price Ticker Widget', 'ceres'),
			'slug'     				=> 'cryptocurrency-price-ticker-widget',
			'required' 				=> false,
			'version' 				=> '1.7',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('AddToAny Share Buttons', 'ceres'),
			'slug'     				=> 'add-to-any',
			'required' 				=> false,
			'version' 				=> '1.7.26',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('Contact Form 7', 'ceres'),
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,
			'version' 				=> '5.0.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('WooCommerce', 'ceres'),
			'slug'     				=> 'woocommerce',
			'required' 				=> false,
			'version' 				=> '3.3.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'                 => esc_html__('ICO Calendar Space-Themes', 'ceres'),
			'slug'                 => 'ico-calendar-space-themes',
			'source'               => get_template_directory() . '/plugins/ico-calendar-space-themes.zip',
			'required'             => true,
			'version'              => '1.0.1',
			'force_activation'     => false,
			'force_deactivation'   => false,
			'external_url'         => '',
		)

	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}

/*  Ceres Register Required Plugins End */