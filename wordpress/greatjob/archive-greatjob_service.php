<?php
/**
 * Services archive — header, the same grid section as the homepage, footer.
 *
 * @package GreatJob
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php get_template_part( 'template-parts/services-grid' ); ?>
	</main><!-- #main -->

<?php
get_footer();
