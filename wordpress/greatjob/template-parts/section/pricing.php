<?php
/**
 * Pricing flexible content layout.
 *
 * Cards come from the greatjob_pricing CPT (all published, ordered by menu_order),
 * not from fields on this layout. Color/art are per-card ACF fields so an editor
 * can add/remove plans and restyle them without touching code.
 *
 * @package GreatJob
 */

$assets = get_template_directory_uri() . '/assets/images/pricing';

$plans = get_posts(
	array(
		'post_type'      => 'greatjob_pricing',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

if ( ! $plans ) {
	return;
}
?>
<section class="section pricing" id="pricing">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
		<div class="pricing-grid">
			<?php foreach ( $plans as $plan ) : ?>
				<?php
				$card_color     = get_field( 'card_color', $plan->ID ) ?: '#edfbff';
				$features_color = get_field( 'features_color', $plan->ID ) ?: '#d8f6ff';
				$art            = get_field( 'art', $plan->ID );
				$features       = get_field( 'features', $plan->ID );
				$badge_label    = get_field( 'badge_label', $plan->ID );
				$badge_color    = get_field( 'badge_color', $plan->ID ) ?: '#ffca00';
				$button_text    = get_field( 'button_text', $plan->ID ) ?: 'Выбрать тариф';
				$button_url     = get_field( 'button_url', $plan->ID ) ?: '#contact';
				?>
				<article class="pricing-card" style="background-color: <?php echo esc_attr( $card_color ); ?>;">
					<?php if ( $art && 'none' !== $art ) : ?>
						<img class="pricing-card__art pricing-card__art--<?php echo esc_attr( $art ); ?>" src="<?php echo esc_url( $assets . '/pricing-' . $art . '-art.svg' ); ?>" alt="" aria-hidden="true">
					<?php endif; ?>
					<div class="pricing-card__inner">
						<div class="pricing-card__header">
							<h3 class="pricing-card__title"><?php echo esc_html( get_the_title( $plan ) ); ?></h3>
							<div class="pricing-card__price-block">
								<strong class="pricing-card__price"><?php echo esc_html( get_field( 'price', $plan->ID ) ); ?></strong>
								<span class="pricing-card__saving"><?php echo esc_html( get_field( 'saving', $plan->ID ) ); ?></span>
							</div>
						</div>
						<?php if ( $features ) : ?>
							<ul class="pricing-card__features" style="background-color: <?php echo esc_attr( $features_color ); ?>;">
								<?php foreach ( $features as $feature ) : ?>
									<li class="pricing-card__feature">
										<img class="pricing-card__feature-icon" src="<?php echo esc_url( $assets . '/pricing-star.svg' ); ?>" alt="" aria-hidden="true">
										<span><?php echo esc_html( $feature['text'] ); ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<a class="pricing-card__button button button--dark" href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_text ); ?></a>
					</div>
					<?php if ( $badge_label ) : ?>
						<span class="pricing-card__badge" style="background-color: <?php echo esc_attr( $badge_color ); ?>; color: <?php echo esc_attr( greatjob_contrast_text_color( $badge_color ) ); ?>;"><?php echo esc_html( $badge_label ); ?></span>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
