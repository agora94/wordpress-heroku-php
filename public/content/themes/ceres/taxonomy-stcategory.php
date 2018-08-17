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

				<!-- Archive Start -->

				<div class="space-single-page-wrap cont relative space-ico-archive">
					<div class="space-single-page white-15 relative">
						<div class="space-single-page-ins relative">
							<div class="space-single-page-box relative">
								<div class="space-ico-archive-loop relative">

								<!-- Archive Loop ICO Start -->

									<?php if ( have_posts() ) :
											while ( have_posts() ) : the_post();

										$start_date = esc_html( get_post_meta( get_the_ID(), 'start_date', true ) );
										$end_date = esc_html( get_post_meta( get_the_ID(), 'end_date', true ) );
										$short_description = esc_html( get_post_meta( get_the_ID(), 'short_description', true ) );
									?>

									<div class="space-ico-archive-loop-item relative">
										<div class="space-ico-archive-loop-item-left box-66 left relative">
											<?php $archive_ico_logo = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-ico-calendar-3'); if ($archive_ico_logo) { ?>
											<div class="space-ico-archive-loop-item-logo absolute">
												<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php echo esc_url($archive_ico_logo[0]); ?>" alt="<?php the_title(); ?>"></a>
											</div>
											<?php } ?>
											<div class="space-ico-archive-loop-item-title relative">
												<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
												<?php if ($short_description) { ?>
												<p><?php echo esc_html( $short_description); ?></p>
												<?php } ?>
											</div>
										</div>
										<div class="space-ico-archive-loop-item-right box-33 left relative">
											<div class="space-ico-archive-loop-item-date relative"><span><?php esc_html_e( 'Start', 'ceres' ); ?></span> <?php echo esc_html( date('M d, Y',strtotime($start_date))); ?></div>
											<div class="space-ico-archive-loop-item-date relative"><span><?php esc_html_e( 'End', 'ceres' ); ?></span> <?php echo esc_html( date('M d, Y',strtotime($end_date))); ?></div>
											<a href="<?php the_permalink() ?>" title="<?php esc_html_e( 'Read more', 'ceres' ); ?>"><?php esc_html_e( 'Read more', 'ceres' ); ?></a>
										</div>
									</div>

									<?php endwhile; ?>

								<!-- Archive Loop ICO End -->

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
							</div>
						</div>
					</div>
				</div>

				<!-- Archive End -->

			</div>
			<div class="space-right-sidebar-two box-25 left relative">
				
				<?php get_sidebar(); ?>

			</div>
		</div>
	</div>

	<!-- Right Sidebar End -->

<?php get_footer(); ?>