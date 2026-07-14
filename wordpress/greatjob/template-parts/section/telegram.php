<?php
/**
 * Telegram CTA flexible content layout.
 *
 * Decorative pattern/people images are hardcoded (bespoke Figma background
 * graphics, same treatment as Hero's accent/wave/bag), not ACF fields.
 *
 * @package GreatJob
 */

$assets      = get_template_directory_uri() . '/assets/images/telegram';
$telegram_url = get_sub_field( 'telegram_url' );
?>
<section class="telegram-cta" id="contact">
	<img class="telegram-cta__pattern" src="<?php echo esc_url( $assets . '/telegram-cta-pattern.svg' ); ?>" alt="" aria-hidden="true">
	<img class="telegram-cta__people" src="<?php echo esc_url( $assets . '/telegram-cta-people.png' ); ?>" alt="" aria-hidden="true">
	<div class="container telegram-cta__inner">
		<div class="telegram-cta__content">
			<h2><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
			<p><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
			<?php if ( $telegram_url ) : ?>
				<a class="telegram-cta__button button button--dark" href="<?php echo esc_url( $telegram_url ); ?>" target="_blank" rel="noreferrer"><?php echo esc_html( get_sub_field( 'button_text' ) ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
