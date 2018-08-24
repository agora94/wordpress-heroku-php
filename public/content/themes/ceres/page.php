<?php get_header(); ?>

	<!-- Title Start -->

	<div class="space-title-box cont relative">
		<div class="space-title-wrap relative">
			<div class="space-title-frame absolute"></div>
			<h1><?php the_title(); ?></h1>
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

				<!-- Single Page Start -->

				<div class="space-single-page-wrap cont relative single-page-style-2">
					<div class="space-single-page white-15 relative">

						<?php if(have_posts()) : ?>
						<?php while(have_posts()) : the_post(); ?>

						<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-single-img-1'); if ($src) { ?>

						<!-- Single Page Image Start -->

<!-- 						<div class="space-single-page-img-2 relative">
							<img src="<?php echo esc_url($src[0]); ?>" alt="<?php the_title(); ?>">
						</div> -->

						<!-- Single Page Image End -->

						<?php } else {} ?>

						<div class="space-single-page-ins relative">
							<div class="space-single-page-box relative">
								<div class="space-single-page-content relative">
									<?php
										the_content();
										wp_link_pages( array(
												'before'      => '<div class="clear"></div><div class="page-links">' . esc_html__( 'Pages:', 'ceres' ),
												'after'       => '</div>',
												'link_before' => '<span class="page-number">',
												'link_after'  => '</span>',
										));
									?>

									<?php endwhile; ?>
									<?php endif; ?>

								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Single Page End -->

				<?php if (comments_open()) { ?>

				<!-- Comments Start -->

				<?php comments_template(); ?>

				<!-- Comments End -->

				<?php } else {} ?>

			</div>
			<div class="space-right-sidebar-two box-25 left relative">

				<?php get_sidebar(); ?>
				
			</div>
		</div>
	</div>

	<!-- Right Sidebar End -->

<?php get_footer(); ?>