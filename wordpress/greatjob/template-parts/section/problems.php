<?php
/**
 * Problems flexible content layout.
 *
 * @package GreatJob
 */
?>
<section class="section problems" id="about">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
		<div class="problem-grid">
			<?php while ( have_rows( 'cards' ) ) : the_row(); ?>
				<article class="problem-card">
					<?php $icon = get_sub_field( 'icon' ); ?>
					<?php if ( $icon ) : ?>
						<img class="problem-card__icon" src="<?php echo esc_url( $icon ); ?>" alt="" aria-hidden="true">
					<?php endif; ?>
					<div class="problem-card__body">
						<h3 class="problem-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
						<p class="problem-card__description"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
</section>
