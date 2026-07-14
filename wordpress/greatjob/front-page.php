<?php
/**
 * The front page template.
 *
 * Renders the ACF flexible content "sections" field row by row.
 * Each layout name maps 1:1 to template-parts/section/{layout}.php.
 *
 * @package GreatJob
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_rows( 'sections' ) ) :
			while ( have_rows( 'sections' ) ) :
				the_row();
				get_template_part( 'template-parts/section/' . get_row_layout() );
			endwhile;
		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
