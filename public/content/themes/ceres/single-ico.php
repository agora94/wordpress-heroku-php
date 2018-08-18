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

				<?php
					$start_date = esc_html( get_post_meta( get_the_ID(), 'start_date', true ) );
					$end_date = esc_html( get_post_meta( get_the_ID(), 'end_date', true ) );
					$website_address = esc_html( get_post_meta( get_the_ID(), 'website_address', true ) );
				?>
				<?php if(have_posts()) :  while(have_posts()) : the_post(); ?>

				<!-- Single Page Start -->

				<div class="space-single-page-wrap cont relative">
					<div class="space-single-page white-15 relative">
						<div class="space-single-page-ins relative">
							<div class="space-single-page-box relative">

								<!-- ICO Company Info Start -->

								<div class="space-company-info relative">
									<?php
										$src_logo = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-ico-calendar-2');
									if ($src_logo) { ?>
									<div class="space-company-info-logo box-33 right relative">
										<img src="<?php echo esc_url($src_logo[0]); ?>" alt="<?php the_title(); ?>">
									</div>
									<div class="space-company-info-meta box-66 right relative">
									<?php } else { ?>
									<div class="space-company-info-meta cont relative">
									<?php } ?>
										<div class="space-company-info-date relative">
											<div class="space-company-info-date-start box-50 left relative">
												<span><?php esc_html_e( 'Start', 'ceres' ); ?></span><?php echo esc_html( date('M d, Y',strtotime($start_date))); ?>
											</div>
											<div class="space-company-info-date-end box-50 left relative">
												<span><?php esc_html_e( 'End', 'ceres' ); ?></span><?php echo esc_html( date('M d, Y',strtotime($end_date))); ?>
											</div>
										</div>
										<?php if(has_excerpt()){ ?>
										<div class="space-company-info-excerpt relative">
											<?php the_excerpt(); ?>
										</div>
										<?php } ?>
										<?php if ($website_address) { ?>
										<div class="space-company-info-url relative">
											<a href="http://<?php echo esc_attr( $website_address ); ?>" title="<?php echo $website_address; ?>" target="_blank"><?php echo esc_html( $website_address ); ?></a>
										</div>
										<?php } ?>
									</div>
								</div>

								<!-- ICO Company Info End -->

								<div class="space-single-page-content relative">
									<h2><?php esc_html_e( 'Description', 'ceres' ); ?></h2>
									<?php the_content();
							
										wp_link_pages( array(
												'before'      => '<div class="clear"></div><nav class="navigation pagination-post">' . esc_html__( 'Pages:', 'ceres' ),
												'after'       => '</nav>',
												'link_before' => '<span class="page-number">',
												'link_after'  => '</span>',
										) );
									?>
										
									<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Single Page End -->

				<?php if ( comments_open() || get_comments_number() ) :?>

				<!-- Comments Start -->

				<?php comments_template(); ?>

				<!-- Comments End -->

				<?php endif; ?>

			</div>
			<div class="space-right-sidebar-two box-25 left relative">
				
				<?php get_sidebar(); ?>

			</div>
		</div>
	</div>

	<!-- Right Sidebar End -->

<?php get_footer(); ?>