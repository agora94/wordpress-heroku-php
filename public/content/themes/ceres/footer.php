</div>

<!-- Footer Start -->

<div class="space-footer cont relative">
	<div class="space-footer-ins space-wrapper relative">
		<div class="space-footer-left box-25 left relative">
			<div class="space-footer-left-ins relative">
				<?php if(get_theme_mod('ceres_footer_logo') == '') { } else { ?>
					<div class="space-footer-left-logo relative"><img src="<?php echo esc_url( get_theme_mod( 'ceres_footer_logo' ) ) ?>" data-rjs="<?php echo esc_url( get_theme_mod( 'ceres_retina_footer_logo' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"></div>
				<?php } ?>
				<div class="space-footer-left-desc">
					<?php echo esc_html( get_bloginfo( 'description' ) ) ?>
				</div>
			</div>
		</div>
		<div class="space-footer-right box-75 left relative">
			<div class="space-footer-right-ins relative">
				<div class="space-footer-right-menu relative">
					<?php wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'footer-menu', 'theme_location' => 'footer-menu', 'depth' => 1, 'fallback_cb' => '__return_empty_string' ) ); ?>
				</div>
				<div class="space-footer-right-social relative">

					<?php get_template_part( '/theme-parts/social-icons' ); ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="space-copy cont relative">
	<div class="space-copy-ins space-wrapper relative">
		<?php if(get_theme_mod('footer_copyright') == '') { ?>
			<?php esc_html_e( '&copy; Copyright 2018.', 'ceres' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"><?php echo esc_html( get_bloginfo( 'name' ) ) ?></a>. <?php esc_html_e( 'Designed by ', 'ceres' ); ?> <a href="<?php echo esc_url( __( 'https://space-themes.com/', 'ceres' ) ); ?>" target="_blank" title="<?php esc_attr( 'Space-Themes.com', 'ceres' ); ?>"><?php esc_html_e( 'Space-Themes.com', 'ceres' ); ?></a>.
		<?php } else { ?>
			<?php echo esc_html( get_theme_mod( 'footer_copyright' ) ) ?>
		<?php } ?>
	</div>
</div>

<!-- Footer End -->

<!-- Back to Top Start -->

<div class="space-totop">
	<a href="#" id="scrolltop" title="<?php esc_attr_e( 'Back to Top', 'ceres' ); ?>"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<!-- Back to Top End -->

<!-- Mobile Menu Start -->

<?php get_template_part( '/theme-parts/mobile-menu' ); ?>

<!-- Mobile Menu End -->

<?php wp_footer(); ?>

</body>
</html>