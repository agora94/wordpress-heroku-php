<?php get_header(); ?>

	<!-- Title Start -->

	<div class="space-title-box cont relative">
		<div class="space-title-wrap relative">
			<div class="space-title-frame absolute"></div>
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="space-breadcrumbs relative">
			<?php woocommerce_breadcrumb(); ?>
		</div>
	</div>

	<!-- Title End -->

	<!-- Right Sidebar Start -->

	<div class="space-right-sidebar relative">
		<div class="space-right-sidebar-ins cont relative">
			<div class="space-right-sidebar-one box-75 left relative">
				<div class="space-single-page-wrap cont relative single-page-style-2">
					<div class="space-single-page white-15 relative">
						<div class="space-single-page-ins relative">
							<div class="space-single-page-box relative">
								<div class="space-single-page-content relative">
									
									<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'single-product' ); ?>

									<?php endwhile; ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="space-right-sidebar-two box-25 left relative">

				<?php
					if ( is_active_sidebar( 'shop-sidebar' ) ) :
						dynamic_sidebar( 'shop-sidebar' );
					endif;
				?>
				
			</div>
		</div>
	</div>

	<!-- Right Sidebar End -->

<?php get_footer(); ?>