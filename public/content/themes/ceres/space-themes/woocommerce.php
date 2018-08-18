<?php

/* WooCommerce Support Start */

add_action( 'after_setup_theme', 'ceres_woocommerce_support' );
function ceres_woocommerce_support() {
    add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

/* Change the breadcrumb separator */

add_filter( 'woocommerce_breadcrumb_defaults', 'ceres_change_breadcrumb_delimiter' );
function ceres_change_breadcrumb_delimiter( $defaults ) {

	$defaults['delimiter'] = wp_kses( ' <span>&raquo;</span> ', array('span' => array('class' => array())) );
	return $defaults;
}

/* Change number or products per row to 3 */

add_filter('loop_shop_columns', 'ceres_loop_columns');
if (!function_exists('ceres_loop_columns')) {
	function ceres_loop_columns() {
		return 3;
	}
}

/* Change number of related products output */

function ceres_related_products_limit() {
  global $product;
	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ceres_related_products_args' );
  function ceres_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

/* Remove single product title output */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

/* WooCommerce Support End */