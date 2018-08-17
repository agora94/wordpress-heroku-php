	<!-- Right Sidebar Start -->

	<div class="space-right-sidebar relative">
		<div class="space-right-sidebar-ins cont relative">
			<div class="space-right-sidebar-one box-75 left relative">

				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					<?php if(function_exists('ceres_setPostViews')) { ceres_setPostViews(get_the_ID()); }?>

				<!-- Single Page Start -->

				<div class="space-single-page-wrap cont relative">
					<div class="space-single-page white-15 relative">
						<div class="space-single-page-ins relative">
							<div class="space-single-page-box relative">
								<div class="space-single-page-category relative"><?php the_category(', '); ?></div>
								<?php if(has_excerpt()){ ?>
								<div class="space-single-page-excerpt relative">
									<div class="space-single-page-excerpt-box relative">
										<?php the_excerpt(); ?>
									</div>
								</div>
								<?php } else {} ?>
								<div class="space-single-page-img relative">
									<div class="space-single-page-img-meta-3 cont space-common-meta relative">
										<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?> <span class="by"><?php esc_html_e( 'by', 'ceres' ); ?></span> <?php the_author_posts_link(); ?>
										<?php $caption = get_the_post_thumbnail_caption(); if ($caption) { ?>
										<div class="space-single-page-alt-3 relative"><?php esc_html_e( 'Photo:', 'ceres' ); ?> <?php echo esc_html($caption); ?></div>
										<?php } ?>
									</div>
									<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-single-img-1'); if ($src) { ?>
									<div class="space-single-page-img-pic-3 cont relative">
										<img src="<?php echo esc_url($src[0]); ?>" alt="<?php the_title(); ?>">
									</div>
									<?php } ?>
								</div>
								<div class="space-single-page-content relative">
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
								<?php
									$tag_title = esc_html__('Tags:', 'ceres' );
									the_tags('<div class="space-single-page-tags space-common-meta relative"><span><i class="fa fa-tags" aria-hidden="true"></i> '.$tag_title .'</span>', ', ', '</div>');
								?>
							</div>
						</div>
					</div>
				</div>

				<!-- Single Page End -->

				<?php if( get_theme_mod('ceres_related_posts') ) { ?>

				<!-- Read More Box Start -->

				<?php get_template_part( '/theme-parts/read-more-box' ); ?>

				<!-- Read More Box End -->

				<?php } ?>

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