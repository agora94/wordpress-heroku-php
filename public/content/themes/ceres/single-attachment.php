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

	<!-- Full Width Start -->

	<div id="post-<?php the_ID(); ?>" class="space-full-width relative">
		<div class="space-full-width-ins cont relative">
			<div class="space-full-width-one relative">

				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					<?php if(function_exists('ceres_setPostViews')) { ceres_setPostViews(get_the_ID()); }?>

				<!-- Single Page Start -->

				<div class="space-single-page-wrap cont relative">
					<div class="space-single-page white-15 relative">
						<div class="space-single-page-ins relative">
							<div class="space-single-page-box relative">
								<div class="space-single-page-category relative"><?php the_category(', '); ?></div>
								<div class="space-single-page-img relative">
									<div class="space-single-page-img-meta space-common-meta cont relative">
										<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?> <span class="by"><?php esc_html_e( 'by', 'ceres' ); ?></span> <?php the_author_posts_link(); ?>
									</div>
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

				<?php if ( comments_open() || get_comments_number() ) :?>

				<!-- Comments Start -->

				<?php comments_template(); ?>

				<!-- Comments End -->

				<?php endif; ?>

			</div>
		</div>
	</div>

	<!-- Full Width End -->

<?php get_footer(); ?>