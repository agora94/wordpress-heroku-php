<?php
	if ( post_password_required() ) {
		return;
	}
?>
				<div id="comments" class="space-comments cont relative">
					<div class="space-comments-ins white-15 relative">
						<div class="space-comments-wrap space-single-page-content relative">
							<?php
							if ( have_comments() ) : ?>
								<h2>
									<?php
										$comments_number = get_comments_number();
										if ( '1' === $comments_number ) {
											printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'ceres' ), get_the_title() );
										} else {
											printf(
												_nx(
													'%1$s Reply to &ldquo;%2$s&rdquo;',
													'%1$s Replies to &ldquo;%2$s&rdquo;',
													$comments_number,
													'comments title',
													'ceres'
												),
												number_format_i18n( $comments_number ),
												get_the_title()
											);
										}
									?>
								</h2>
								<div class="space-comments-list relative">
								<ul class="comment-list">
									<?php
										wp_list_comments( array(
											'avatar_size' => 70,
											'style'       => 'ul',
											'short_ping'  => true,
											'callback'    => 'ceres_comment',
											'reply_text'  => esc_html__( 'Reply', 'ceres' ),
										) );
									?>
								</ul>
								</div>
								<?php the_comments_pagination( array(
									'prev_text' => '' . esc_html__( '&laquo;', 'ceres' ) . '',
									'next_text' => '' . esc_html__( '&raquo;', 'ceres' ) . '',
								) );
							endif;
							if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

							<?php endif;
							$comments_args = array(
								'fields' => array(
									'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="'. esc_attr__( 'Name*', 'ceres' ) .'" /></p>',
									'email'  => '<p class="comment-form-email"><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes" placeholder="'. esc_attr__( 'Email*', 'ceres' ) .'" /></p>',
									'url'    => '<p class="comment-form-url"><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'. esc_attr__( 'Website', 'ceres' ) .'" /></p>',
								),
								'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required" placeholder="'. esc_attr__( 'Comment*', 'ceres' ) .'"></textarea></p>',
								);
							comment_form( $comments_args ); ?>
						</div>
					</div>
				</div>