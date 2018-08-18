<?php
/*
Template Name: Homepage Left Sidebar
*/
?>
<?php get_header(); ?>

	<!-- Left Sidebar Start -->

	<div class="space-right-sidebar home-page relative">
		<div class="space-right-sidebar-ins cont relative">
			<div class="space-right-sidebar-one box-75 right relative">

				<?php
					if ( is_active_sidebar( 'homepage-central-box' ) ) :
						dynamic_sidebar( 'homepage-central-box' );
					endif;
				?>

			</div>
			<div class="space-right-sidebar-two box-25 right relative">
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

	<!-- Left Sidebar End -->

<?php get_footer(); ?>