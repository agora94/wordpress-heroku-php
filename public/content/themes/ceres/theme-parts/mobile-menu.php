<div class="space-mobile-menu-wrap">
	<div class="space-mobile-menu-block">
		<div class="space-mobile-menu-block-ins">
			<div class="space-mobile-menu-items relative">
				<?php wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'mobile-menu', 'theme_location' => 'main-menu', 'depth' => 3, 'fallback_cb' => '__return_empty_string' ) ); ?>
			</div>
			<div class="space-mobile-search-block relative">
				<div class="space-mobile-search-block-ins relative">
					<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
						<input type="text" value="<?php echo get_search_query() ?>" name="s" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'ceres' ); ?>">
					</form>
				</div>
			</div>
			<div class="space-mobile-social relative">
				
				<?php get_template_part( '/theme-parts/social-icons' ); ?>
				
			</div>
			<div class="space-mobile-exit absolute">
				<div class="to-right absolute"></div>
				<div class="to-left absolute"></div>
			</div>
		</div>
	</div>
</div>