<?php
/**
 * Hero flexible content layout.
 *
 * @package GreatJob
 */

$avatars = array();
if ( have_rows( 'avatars' ) ) :
	while ( have_rows( 'avatars' ) ) :
		the_row();
		$avatar_image = get_sub_field( 'image' );
		if ( $avatar_image ) {
			$avatars[] = $avatar_image;
		}
	endwhile;
endif;

$primary_button = get_sub_field( 'primary_button' );
$telegram_url   = get_sub_field( 'telegram_url' );

$stats          = array(
	get_sub_field( 'stat_one' ),
	get_sub_field( 'stat_two' ),
	get_sub_field( 'stat_three' ),
);
$stat_modifiers = array( '', ' hero-stat--wide', '' );

$assets = get_template_directory_uri() . '/assets/images';
?>
<section class="hero" id="top">
	<div class="hero__layout">
		<div class="hero__visual">
			<img class="hero__texture" src="<?php echo esc_url( $assets . '/hero-texture.jpg' ); ?>" alt="" aria-hidden="true">
			<div class="hero__inner">
				<h1 class="hero__title">
					<span class="hero__title-line hero__title-line--first">
						<span><?php echo esc_html( get_sub_field( 'heading_line_1_start' ) ); ?></span>
						<?php if ( $avatars ) : ?>
							<span class="hero__avatars" aria-hidden="true">
								<?php foreach ( $avatars as $avatar_url ) : ?>
									<img src="<?php echo esc_url( $avatar_url ); ?>" alt="">
								<?php endforeach; ?>
							</span>
						<?php endif; ?>
						<span><?php echo esc_html( get_sub_field( 'heading_line_1_end' ) ); ?></span>
						<img class="hero__accent" src="<?php echo esc_url( $assets . '/hero-accent.svg' ); ?>" alt="" aria-hidden="true">
					</span>
					<span class="hero__title-line hero__title-line--second">
						<span><?php echo esc_html( get_sub_field( 'heading_line_2_start' ) ); ?></span>
						<img class="hero__wave" src="<?php echo esc_url( $assets . '/hero-wave.svg' ); ?>" alt="" aria-hidden="true">
						<span><?php echo esc_html( get_sub_field( 'heading_line_2_end' ) ); ?></span>
					</span>
					<span class="hero__title-line hero__title-line--third">
						<span><?php echo esc_html( get_sub_field( 'heading_line_3' ) ); ?></span>
						<img class="hero__bag" src="<?php echo esc_url( $assets . '/hero-bag.svg' ); ?>" alt="" aria-hidden="true">
					</span>
				</h1>
				<p class="hero__description"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
				<div class="hero__actions">
					<?php if ( $primary_button && ! empty( $primary_button['url'] ) ) : ?>
						<a class="button button--hero" href="<?php echo esc_url( $primary_button['url'] ); ?>"<?php echo ! empty( $primary_button['target'] ) ? ' target="' . esc_attr( $primary_button['target'] ) . '"' : ''; ?>><?php echo esc_html( $primary_button['title'] ); ?></a>
					<?php endif; ?>
					<?php if ( $telegram_url ) : ?>
						<a class="icon-button icon-button--telegram-black" href="<?php echo esc_url( $telegram_url ); ?>" aria-label="Открыть Telegram" target="_blank" rel="noopener">
							<img class="icon-button__icon" src="<?php echo esc_url( $assets . '/telegram-black.svg' ); ?>" alt="" aria-hidden="true">
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="hero__stats">
			<?php
			foreach ( $stats as $index => $stat ) :
				if ( ! $stat ) {
					continue;
				}
				$value     = (int) $stat['value'];
				$suffix    = (string) $stat['suffix'];
				$label     = (string) $stat['label'];
				$formatted = number_format( $value, 0, '', ' ' );
				?>
				<article class="hero-stat<?php echo esc_attr( $stat_modifiers[ $index ] ?? '' ); ?>">
					<strong class="hero-stat__value" data-target="<?php echo esc_attr( $value ); ?>" data-suffix="<?php echo esc_attr( $suffix ); ?>">
						<span class="hero-stat__value-current" aria-hidden="true">0<?php echo esc_html( $suffix ); ?></span>
						<span class="hero-stat__value-target"><?php echo esc_html( $formatted . $suffix ); ?></span>
					</strong>
					<p class="hero-stat__label"><?php echo esc_html( $label ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
