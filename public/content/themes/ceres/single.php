<?php get_header(); ?>

	<!-- Title Start -->

	<div class="space-title-box cont relative">
		<div class="space-title-wrap relative">
			<div class="space-title-frame absolute"></div>
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="space-breadcrumbs relative">
			<?php if (function_exists('ceres_breadcrumbs')) ceres_breadcrumbs(); ?>
		</div>
	</div>

	<!-- Title End -->

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

		$header_style = get_post_meta( get_the_ID(), 'header_style', true );

		if ($header_style == 1) {
			get_template_part( '/theme-parts/single/style-1' ); }
		else if ($header_style == 2) {
			get_template_part( '/theme-parts/single/style-2' ); }
		else if ($header_style == 3) {
			get_template_part( '/theme-parts/single/style-3' ); }
		else if ($header_style == 4) {
			get_template_part( '/theme-parts/single/style-4' ); }
		else if ($header_style == 5) {
			get_template_part( '/theme-parts/single/style-5' ); }
		else if ($header_style == 6) {
			get_template_part( '/theme-parts/single/style-6' ); }
		else {
			get_template_part( '/theme-parts/single/style-1' ); }
	?>
	</div>

<?php get_footer(); ?>