				<div class="space-archive-loop cont relative">
					<div class="space-archive-loop-ins white-15 relative">
						<?php $archive_loop_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ceres-archive-loop-img'); if ($archive_loop_img) { ?>
						<?php if ( 'ico' == get_post_type() ) { ?>
						<div class="space-archive-loop-meta cont relative">
						<?php } else { ?>
						<div class="space-archive-loop-img box-33 left relative">
							<div class="space-archive-loop-img-ins relative">
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php echo esc_url($archive_loop_img[0]); ?>" alt="<?php the_title(); ?>"></a>
							</div>
						</div>
						<div class="space-archive-loop-meta box-66 left relative">
						<?php } ?>
						<?php } else { ?>
						<div class="space-archive-loop-meta cont relative">
						<?php } ?>
							<div class="space-archive-loop-meta-ins relative">
								<div class="space-archive-loop-category relative"><?php the_category(', '); ?></div>
								<div class="space-archive-loop-title relative"><?php if ( is_sticky() ) { ?><i class="fa fa-paperclip" aria-hidden="true"></i> <?php } ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
								<div class="space-archive-loop-meta-info space-common-meta relative">
									<i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(); ?> <span><i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></span>
								</div>
								<div class="space-archive-loop-excerpt relative">
									<?php echo esc_html(wp_trim_words( get_the_excerpt(), 30, ' ...' )); ?>
								</div>
							</div>
						</div>
					</div>
				</div>