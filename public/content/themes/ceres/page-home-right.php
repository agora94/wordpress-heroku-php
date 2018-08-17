<?php
/*
Template Name: Homepage Right Sidebar
*/
?>
<?php get_header(); ?>

	<!-- Right Sidebar Start -->

	<div class="space-right-sidebar home-page relative">
		<div class="space-right-sidebar-ins cont relative">
			<div class="space-right-sidebar-one box-75 left relative">

				<?php
					if ( is_active_sidebar( 'homepage-central-box' ) ) :
						dynamic_sidebar( 'homepage-central-box' );
					endif;
				?>

			</div>
			<div class="space-right-sidebar-two box-25 left relative">
				<div class="theiaStickySidebar">
				<?php
					if ( is_active_sidebar( 'homepage-small-box' ) ) :
						dynamic_sidebar( 'homepage-small-box' );
					endif;
				?>
				</div>
			</div>
		</div>
	</div>

	<!-- Right Sidebar End -->

<?php get_footer(); ?>