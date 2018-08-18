<?php get_header(); ?>

	<!-- Title Start -->

	<div class="space-title-box cont relative">
		<div class="space-title-wrap relative">
			<div class="space-title-frame absolute"></div>
			<h1><?php esc_html_e( 'Error 404', 'ceres' ); ?></h1>
		</div>
		<div class="space-breadcrumbs relative">
			<?php if (function_exists('ceres_breadcrumbs')) ceres_breadcrumbs(); ?>
		</div>
	</div>

	<!-- Title End -->

	<!-- Full Width Start -->

	<div class="space-full-width relative">
		<div class="space-full-width-ins cont relative">
			<div class="space-full-width-one relative">

				<!-- Single Page Start -->

				<div class="space-single-page-wrap cont relative single-page-style-2">
					<div class="space-single-page white-15 relative">

						<div class="space-single-page-ins relative">
							<div class="space-single-page-box relative">
								<div class="space-single-page-content relative">
									<h2><?php esc_html_e( 'Page not Found', 'ceres' ); ?></h2>
									<p><?php esc_html_e( 'Nothing found.', 'ceres' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"><?php esc_html_e( 'Go back to home page', 'ceres' ); ?></a>.</p>
									<div class="space-widget-default-title relative"><?php esc_html_e( 'Search', 'ceres' ); ?></div>
									<?php get_search_form(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Single Page End -->

			</div>
		</div>
	</div>

	<!-- Full Width End -->

<?php get_footer(); ?>