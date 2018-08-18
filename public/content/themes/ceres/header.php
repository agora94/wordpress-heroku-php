<?php ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="space-wrapper relative">

	<!-- Header Start -->

	<div class="space-header-box absolute">
		<div class="space-header-wrap relative">
			<div class="space-header white-15 relative">
				<div class="cont relative">
					<div class="space-header-logo-wrap box-25 left relative">
						<div class="space-header-logo relative">
							<?php
								$custom_logo_id = get_theme_mod( 'custom_logo' );
								$logo = wp_get_attachment_image_src( $custom_logo_id , 'ceres-custom-logo' );
								if ( has_custom_logo() ) {
								echo '<a href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_attr( get_bloginfo( 'name' ) ) .'"><img src="'. esc_url( $logo[0] ) .'" data-rjs="2" alt="'. esc_attr( get_bloginfo( 'name' ) ) .'"></a>';
								} else {
								echo '<a href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_attr( get_bloginfo( 'name' ) ) .'" class="text-logo">'. esc_html( get_bloginfo( 'name' ) ) .'<span>'. esc_html( get_bloginfo( 'description' ) ) .'</span></a>';
								}
							?>
						</div>
						<div class="space-mobile-menu-icon absolute">
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
					<div class="space-header-menu-wrap box-75 left">
						<div class="space-header-menu">
							<?php wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'main-menu', 'theme_location' => 'main-menu', 'depth' => 3, 'fallback_cb' => '__return_empty_string', 'walker' => new ceres_mega_menu() ) ); ?>
						</div>
						<div class="space-header-search absolute">
							<i class="fa fa-search desktop-search-button" aria-hidden="true"></i>
						</div>
						<div class="space-header-search-block absolute">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Header End -->