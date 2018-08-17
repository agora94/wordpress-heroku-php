				<div class="space-read-more-box relative">

					<!-- Read More Box Title Start -->

					<div class="space-read-more-title cont relative">
						<div class="space-read-more-wrap relative">
							<?php esc_html_e( 'Read more', 'ceres' ); ?>
						</div>
					</div>

					<!-- Read More Box Title End -->

					<!-- Read More Box - Widget #5 Start -->

					<div class="space-widget-5 cont relative">

						<?php
							$args = array( 'posts_per_page' => 3, 'category__in' => wp_get_post_categories($post->ID), 'exclude' => $post->ID);
							$mercury_related = get_posts( $args );
							if( $mercury_related ) foreach( $mercury_related as $post ){ setup_postdata($post);
						?>

						<div class="space-widget-5-item box-33 left relative">
							<div class="space-widget-5-item-ins white-15 relative">
								<?php $widget_5_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-widget-5'); if ($widget_5_img) { ?>
								<div class="space-widget-5-item-img relative">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo esc_url($widget_5_img[0]); ?>" alt="<?php the_title(); ?>"></a>
								</div>
								<?php } else {} ?>
								<div class="space-widget-5-item-info relative">
									<div class="space-widget-5-category relative"><?php the_category(', '); ?></div>
									<div class="space-widget-5-title relative"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
									<div class="space-widget-5-meta space-common-meta relative">
											<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?> <span class="right"><i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span>
									</div>
								</div>
							</div>
						</div>

						<?php } else { ?>
							<div class="white-15 relative">
								<div class="space-single-page-ins space-single-page-content relative">
									<?php esc_html_e( 'Sorry, no other posts related this article.', 'ceres' ); ?> 
								</div>
							</div>
						<?php } wp_reset_postdata(); ?>

					</div>

					<!-- Read More Box - Widget #5 End -->

				</div>