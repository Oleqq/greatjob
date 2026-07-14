<?php
/**
 * Metrics flexible content layout.
 *
 * Five bespoke cards with hand-tuned per-card art positioning (see _metrics.scss) —
 * not a repeater, the layout and artwork are fixed by design.
 *
 * @package GreatJob
 */

$assets = get_template_directory_uri() . '/assets/images/metrics';

$cards = array(
	'resume'    => get_sub_field( 'card_resume' ),
	'vacancies' => get_sub_field( 'card_vacancies' ),
	'companies' => get_sub_field( 'card_companies' ),
	'support'   => get_sub_field( 'card_support' ),
	'strategy'  => get_sub_field( 'card_strategy' ),
);

$metrics_card = function ( $modifier ) use ( $cards, $assets ) {
	$card = $cards[ $modifier ];
	if ( ! $card ) {
		return;
	}
	?>
	<article class="metrics-card metrics-card--<?php echo esc_attr( $modifier ); ?>">
		<div class="metrics-card__art" aria-hidden="true">
			<img class="metrics-card__svg" src="<?php echo esc_url( $assets . '/metrics-' . $modifier . '-art.svg' ); ?>" alt="" aria-hidden="true">
		</div>
		<div class="metrics-card__content">
			<h3 class="metrics-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
			<p class="metrics-card__description"><?php echo esc_html( $card['description'] ); ?></p>
		</div>
	</article>
	<?php
};
?>
<section class="section metrics">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
		<div class="metrics__grid">
			<div class="metrics__column">
				<?php $metrics_card( 'resume' ); ?>
				<?php $metrics_card( 'vacancies' ); ?>
			</div>
			<?php $metrics_card( 'companies' ); ?>
			<div class="metrics__column">
				<?php $metrics_card( 'support' ); ?>
				<?php $metrics_card( 'strategy' ); ?>
			</div>
		</div>
	</div>
</section>
