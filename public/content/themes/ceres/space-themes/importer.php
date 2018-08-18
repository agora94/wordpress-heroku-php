<?php 

function ceres_import_files() {

  return array(
    array(

      'import_file_name'             => esc_html__( 'Ceres Demo', 'ceres' ),
      'categories'                   => array( 'Newspaper', 'Magazine' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-data/content.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-data/widgets.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-data/options.dat',
      'import_preview_image_url'     => 'http://demo.space-themes.com/screenshots/screenshot-ceres.png',
      'import_notice'                => esc_html__( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'ceres' ),
    ),
  );
}

add_filter( 'pt-ocdi/import_files', 'ceres_import_files' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function ceres_after_import_setup() {

    $front_page_id = get_page_by_title( 'Home' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );

	$main_menu   = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
		'main-menu'   => $main_menu->term_id,
	));

  $footer_menu   = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
  set_theme_mod( 'nav_menu_locations', array(
    'footer-menu'   => $footer_menu->term_id,
  ));
}

add_action( 'pt-ocdi/after_import', 'ceres_after_import_setup' );