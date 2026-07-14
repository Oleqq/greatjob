<?php
/**
 * Steps flexible content layout.
 *
 * Three bespoke cards with per-card colors and hand-tuned art width (see _steps.scss) —
 * not a repeater, the layout and artwork are fixed by design.
 *
 * @package GreatJob
 */

$assets = get_template_directory_uri() . '/assets/images/steps';

$cards = array(
	'goal'      => array( 'field' => get_sub_field( 'card_goal' ), 'art' => 'step-1-art' ),
	'employers' => array( 'field' => get_sub_field( 'card_employers' ), 'art' => 'step-2-art' ),
	'offer'     => array( 'field' => get_sub_field( 'card_offer' ), 'art' => 'step-3-art' ),
);
?>
<section class="section steps">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
		<div class="steps__grid">
			<?php foreach ( $cards as $modifier => $card ) : ?>
				<?php if ( ! $card['field'] ) { continue; } ?>
				<article class="step-card step-card--<?php echo esc_attr( $modifier ); ?>">
					<div class="step-card__content">
						<h3 class="step-card__title"><?php echo esc_html( $card['field']['title'] ); ?></h3>
						<p class="step-card__description"><?php echo esc_html( $card['field']['description'] ); ?></p>
					</div>
					<img class="step-card__art" src="<?php echo esc_url( $assets . '/' . $card['art'] . '.svg' ); ?>" alt="" aria-hidden="true">
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
