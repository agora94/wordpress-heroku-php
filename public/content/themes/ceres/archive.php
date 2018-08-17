<?php get_header(); ?>

	<!-- Title Start -->

	<div class="space-title-box cont relative">
		<div class="space-title-wrap relative">
			<div class="space-title-frame absolute"></div>
			<h1><?php the_archive_title( '', '' );?></h1>
		</div>
		<div class="space-breadcrumbs relative">
			<?php if (function_exists('ceres_breadcrumbs')) ceres_breadcrumbs(); ?>
		</div>
	</div>

	<!-- Title End -->

	<!-- Right Sidebar Start -->

	<div class="space-right-sidebar relative">
		<div class="space-right-sidebar-ins cont relative">
			<div class="space-right-sidebar-one box-75 left relative">

				<!-- Archive Loop Start -->

					<?php
						if ( have_posts() ) :
						while ( have_posts() ) : the_post();

							get_template_part( '/theme-parts/archive/loop' );

						endwhile;
					?>

				<!-- Archive Loop End -->

				<!-- Archive Navigation Start -->

					<?php
						the_posts_pagination( array(
							'end_size' => 2,
							'prev_text'    => esc_html__('&laquo;', 'ceres'),
							'next_text'    => esc_html__('&raquo;', 'ceres'),
						));
					?>

				<!-- Archive Navigation End -->
						
				<?php else : ?>
						
					<div class="white-15 relative">
						<div class="space-single-page-ins space-single-page-content relative">
							<?php esc_html_e( 'Posts not found.', 'ceres' ); ?> 
						</div>
					</div>
						
				<?php endif; ?>

			</div>
			<div class="space-right-sidebar-two box-25 left relative">

				<?php get_sidebar(); ?>
				
			</div>
		</div>
	</div>

	<!-- Right Sidebar End -->

<?php get_footer(); ?>