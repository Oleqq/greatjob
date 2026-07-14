<?php
/**
 * Single service page.
 *
 * No bespoke Figma design was provided for this page — kept simple and
 * functional: title, full description, the same feature list as the card.
 *
 * @package GreatJob
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php while ( have_posts() ) : the_post(); ?>
			<section class="section">
				<div class="container">
					<h1 class="section-title"><?php the_title(); ?></h1>

					<?php if ( have_rows( 'features' ) ) : ?>
						<ul class="service-card__features">
							<?php while ( have_rows( 'features' ) ) : the_row(); ?>
								<li class="service-card__feature">
									<img class="service-card__feature-icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/services/service-star.svg' ); ?>" alt="" aria-hidden="true">
									<span><?php echo esc_html( get_sub_field( 'text' ) ); ?></span>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>

					<?php if ( get_the_content() ) : ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>

					<p><a class="button" href="<?php echo esc_url( get_post_type_archive_link( 'greatjob_service' ) ); ?>">Все услуги</a></p>
				</div>
			</section>
		<?php endwhile; ?>
	</main><!-- #main -->

<?php
get_footer();
