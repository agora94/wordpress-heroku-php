<?php get_header(); ?>

<section id="primary" class="container main_content_area">

			<div class="row full_width_list">
				<div class="col12">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();


				endwhile; // End of the loop.

				?>

				</div><!-- close col12 just inside .full_width_list -->
			</div> <!-- close .full_width_list -->


</section><!-- #primary -->
<?php get_footer();
