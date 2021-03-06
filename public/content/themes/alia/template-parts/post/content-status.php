<?php
$post_classes = array('blog_post_container');
$post_position = '';
if (!isset($alia_post_position) || $alia_post_position != 'related_posts') {
	// add customhentry not hentry, because the hentry class will be deleted in the filter
	// later in alia_remove_hentry() function will check for customentry first then decide to remove hentry or not
	$post_classes[] = 'customhentry';
	$post_position = 'normalhentry';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	
	<?php if (is_single(get_the_ID())): ?>
		<div class="single_post_body">

			<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '
			<p class="single_breadcrumbs" id="breadcrumbs">','</p>
			' );
			}
			?>
			
			<div class="post_header post_header_single">
				<?php
				the_title( '<h1 class="entry-title title post_title">', '</h1>' );
				?>
			</div>

			<?php if (alia_cross_option('alia_meta_info_posts', '', 1)): ?>
			<div class="post_meta_container post_meta_container_single clearfix">

				<?php
					alia_post_meta($post_position);
				?>
			</div>
			<?php endif; ?>
		</div>
	<?php endif ?>
	
	<?php
		$content = apply_filters( 'the_content', get_the_content() );
		

		// preg_match('/<divclass=\"fb-post\"><\/div>/isU', $content, $matches);

		$specific_div = 'fb-post';



		// preg_match_all('#<div\s*(?:id|class)\s*=\s*"'.preg_quote($specific_div).'">(.+?)</div>#is', $content, $match);

		// preg_match_all('#<div[^>]*>(.+?)</div>#is', $content, $match);

		preg_match_all('#<([a-z]+).+?(?:id|class)\s*=\s*("|\')(fb-post|twitter-tweet|fb-video|instagram-media)\2[^>]*>(.+?)</\1>#is', $content, $match);
	?>
		

	<?php
		$post_banner_class = 'no_post_banner';

		if ( isset($alia_content_width) && ($alia_content_width == 'two_coloumns_list' || $alia_content_width == 'grid') ) {
			$alia_post_banner = 'alia_grid_banner';
		}else{
			$alia_post_banner = 'alia_wide_banner';
			if (
				!alia_cross_option('alia_crop_banner_post_list', '', 1) && !is_single(get_the_ID())
				|| !alia_cross_option('alia_crop_banner_inside_post', '', 0) && is_single(get_the_ID())
				) {
					$alia_post_banner = 'alia_full_banner';
			}
		}

		if (isset($alia_content_width) && "" != $alia_content_width) {
			if ($alia_content_width == "wide") {
				$GLOBALS['content_width'] = 880;
			} elseif ($alia_content_width == "grid" || $alia_content_width == 'two_coloumns_list') {
				$GLOBALS['content_width'] = 415;
			}
		}

		if ( !is_single(get_the_ID()) && !empty($match[0][0]) ) {

			if ( ($alia_content_width == 'two_coloumns_list' || $alia_content_width == 'grid' ) && has_post_thumbnail() ): 
				?>
					<figure class="post_banner">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( $alia_post_banner ); ?>
						</a>
					</figure>
					<?php $post_banner_class = 'has_post_banner'; ?>
				<?php 
			else:

				echo '<figure class="post_banner">';
					echo '<div class="status_banner_inner_wrapper">'.$match[0][0].'</div>';
				echo '</figure>';
				$post_banner_class = 'has_post_banner';

			endif;
		}
	?>

	<div class="post_body <?php echo esc_attr($post_banner_class); ?>">
		<?php if (!is_single(get_the_ID())): ?>
			<div class="post_header">
				<?php
				if ( is_front_page() && is_home() ) {
					the_title( '<h3 class="entry-title title post_title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				} else {
					the_title( '<h2 class="entry-title title post_title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
				?>
			</div>
		

			<?php if (alia_cross_option('alia_meta_info_posts', '', 1)): ?>
			<div class="post_meta_container clearfix">

				<?php
					alia_post_meta($post_position);
				?>
			</div>
			<?php endif; ?>
		<?php endif ?>
		
		<div class="post_info_wrapper">
			<?php if ( is_single(get_the_ID()) || 
				( alia_cross_option('alia_blog_show_all_content', '', 0) && isset($alia_content_width) && $alia_content_width == "wide" )
			) {
				echo '<div class="entry-content blog_post_text blog_post_description clearfix">';
					// Only show content if is a single post, or if there's no featured image.
					/* translators: %s: Name of current post */
					the_content( esc_attr__( 'Continue reading', 'alia' ) );

					wp_link_pages( array(
						'before'      => '<div class="single_post_pagination"><div class="page-links">' . esc_attr__( 'Pages:', 'alia' ),
						'after'       => '</div></div>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					) );

					if ( alia_cross_option('alia_show_tags_posts', '', 1) && get_the_tags() ) {
						echo '<div class="tagcloud single_tagcloud clearfix">';
							the_tags('', '', '');
						echo '</div>';
					}
				echo '</div>'; // close .entry-content
			} elseif (!isset($alia_content_layout) || $alia_content_layout != 'layout_with_sidebar') {
				echo '<div class="entry-summary blog_post_text blog_post_description">';
					if ( ($alia_content_width == 'two_coloumns_list' || $alia_content_width == 'grid' ) && has_post_thumbnail() ) {
						echo alia_excerpt(20);
					}else{
						echo alia_excerpt(40);
					}

					echo '<div class="blog_post_control_item blog_post_readmore">';
						// read more link
						echo sprintf( '<a href="%1$s" class="more-link">%2$s<span class="continue_reading_dots"><span class="continue_reading_squares"><span></span><span></span><span></span><span></span></span><i class="fas fa-chevron-right readmore_icon"></i></span></a>',
							esc_url( get_permalink( get_the_ID() ) ),
							esc_attr__( 'Continue reading', 'alia' )

						);

						if ( !post_password_required() && comments_open(get_the_ID()) ) {
							echo '<span class="blog_list_comment_link">';
								$comments_num = '';
								if (get_comments_number() != 0) {
									$comments_num = '<span class="comment_num">'.get_comments_number().'</span>';
								}
								printf('<a href="%1$s">%2$s%3$s</a>',
										get_comments_link(),
										'<i class="far fa-comment-alt"></i>',
										$comments_num
								);

							echo '</span>';
						}

						if (function_exists('alia_blog_list_share_icons') ) {
							alia_blog_list_share_icons();
						}


					echo '</div>'; // end blog_post_control_item
				echo '</div>'; // close .entry-summary
			}
			?>
		</div> <!-- end post_info_wrapper -->
	</div> <!-- end post_body -->
</article>