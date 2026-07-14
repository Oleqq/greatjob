<?php
/**
 * Services grid — shared between the front-page "services" layout and the
 * services archive (header + this + footer). Not a flexible-content layout
 * itself, so it takes $args instead of reading get_sub_field() directly.
 *
 * The main/aside split and the "wide" 2-column card faithfully match the
 * fixed Figma grid (5 cards main incl. one span-2, 3 cards aside with fixed
 * row heights) — this only works cleanly for the original 8 services; extra
 * services beyond that fall back to the grid's implicit auto rows.
 *
 * @package GreatJob
 */

$title = isset( $args['title'] ) ? $args['title'] : 'Список дополнительных услуг';

$services = get_posts(
	array(
		'post_type'      => 'greatjob_service',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

if ( ! $services ) {
	return;
}

$main  = array_slice( $services, 0, 5 );
$aside = array_slice( $services, 5, 3 );
$rest  = array_slice( $services, 8 );

$render_card = function ( $service ) {
	$features = get_field( 'features', $service->ID );
	$wide     = get_field( 'wide_card', $service->ID );
	$assets   = get_template_directory_uri() . '/assets/images/services';
	?>
	<article class="service-card<?php echo $wide ? ' service-card--interviews' : ''; ?>">
		<h3 class="service-card__title"><?php echo esc_html( get_the_title( $service ) ); ?></h3>
		<?php if ( $features ) : ?>
			<ul class="service-card__features">
				<?php foreach ( $features as $feature ) : ?>
					<li class="service-card__feature">
						<img class="service-card__feature-icon" src="<?php echo esc_url( $assets . '/service-star.svg' ); ?>" alt="" aria-hidden="true">
						<span><?php echo esc_html( $feature['text'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<a class="service-card__button button" href="<?php echo esc_url( get_permalink( $service ) ); ?>">Узнать детали</a>
	</article>
	<?php
};
?>
<section class="section services" id="services">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
		<div class="services-grid">
			<div class="services-grid__main">
				<?php foreach ( $main as $service ) : $render_card( $service ); endforeach; ?>
			</div>
			<div class="services-grid__aside">
				<?php foreach ( $aside as $service ) : $render_card( $service ); endforeach; ?>
			</div>
		</div>
		<?php if ( $rest ) : ?>
			<div class="services-grid services-grid--extra">
				<?php foreach ( $rest as $service ) : $render_card( $service ); endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
