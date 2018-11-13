<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site_main_container">

		<header class="site_header">

			<?php if (alia_cross_option('alia_show_top_header_area', '', 1)): ?>

				<?php 
				$custom_header_attr = '';
				if(get_custom_header() && get_header_image()) {
					$custom_header_attr .= ' style=background-image:url('.get_header_image().')';
				}
				?>
			<div class="gray_header" <?php echo esc_attr($custom_header_attr); ?> >
				<div class="container site_header">
					<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
				</div>
			</div>
			<?php endif; ?>

			<div class="header_nav_wrapper">
				<div class="header_nav">

					<div class="container">
						<?php if (alia_cross_option('alia_show_header_site_title', '', 1)): ?>
							<div class="site_branding">
								<?php if ( is_front_page() ) : ?>
									<h1 class="text_logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>
										<?php if (alia_cross_option('alia_show_site_title_dot', '', 1)): ?>
											<span class="logo_dot"></span>
										<?php endif; ?>
									</a></h1>
								<?php else : ?>
									<p class="text_logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>
										<?php if (alia_cross_option('alia_show_site_title_dot', '', 1)): ?>
											<span class="logo_dot"></span>
										<?php endif; ?>
									</a></p>
									<h3 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h3>
								<?php endif; ?>
							</div>
						<?php endif; ?>


						<!-- Place header control before main menu if site title is enabled -->
						<?php if (alia_cross_option('alia_show_header_site_title', '', 1)): ?>
							<div class="header_controls">

								<!-- start search box -->
								<div class="header_search header_control_wrapper">
										<?php get_template_part( 'header', 'searchform' ); ?>
								</div>
								<!-- end search box -->

								<?php if( has_nav_menu( 'top' ) || is_active_sidebar( 'sidebar-sliding' ) ): ?>
								<div class="header_sliding_sidebar_control header_control_wrapper">
									<a id="user_control_icon" class="sliding_sidebar_button" href="#">
										<i class="fas fa-bars header_control_icon"></i>
									</a>
								</div>
								<?php endif; ?>

							</div>
						<?php endif; ?>


						<?php if ( has_nav_menu( 'top' ) ) : ?>
							<div class="main_menu">
								<?php get_template_part( 'template-parts/header/navigation', 'top' ); ?>
								<span class="menu_mark_circle hidden_mark_circle"></span>
							</div>
						<?php endif; ?>

						<!-- Place header control after main menu if site title is enabled -->
						<?php if (!alia_cross_option('alia_show_header_site_title', '', 1)): ?>
							<div class="header_controls">

								<!-- start search box -->
								<div class="header_search header_control_wrapper">
										<?php get_template_part( 'header', 'searchform' ); ?>
								</div>
								<!-- end search box -->

								<?php if( has_nav_menu( 'top' ) || is_active_sidebar( 'sidebar-sliding' ) ): ?>
								<div class="header_sliding_sidebar_control header_control_wrapper">
									<a id="user_control_icon" class="sliding_sidebar_button" href="#">
										<i class="fas fa-bars header_control_icon"></i>
									</a>
								</div>
								<?php endif; ?>

							</div>
						<?php endif; ?>

					</div><!-- end .container -->
				</div><!-- end .header_nav -->
			</div><!-- end .header_nav_wrapper -->
		</header>

		<main id="content" class="site-content">
