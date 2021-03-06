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
	
	<div class="post_body">

		<?php
		if ( is_single(get_the_ID()) && function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '
		<p class="single_breadcrumbs" id="breadcrumbs">','</p>
		' );
		}
		?>

		<?php
		the_title( '<h1 class="entry-title screen-reader-text">', '</h1>' );
		?>

		<?php if (alia_cross_option('alia_meta_info_posts', '', 1)): ?>
		<div class="post_meta_container clearfix">

			<?php
				alia_post_meta($post_position);
			?>
		</div>
		<?php endif; ?>
		
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
			} else {
				echo '<div class="entry-summary blog_post_text blog_post_description">';
					echo alia_excerpt(40);

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