<?php
/**
 * Reviews flexible content layout.
 *
 * Cards come from the greatjob_review CPT (all published, ordered by menu_order),
 * not from fields on this layout.
 *
 * @package GreatJob
 */

$assets = get_template_directory_uri() . '/assets/images/reviews';

$reviews = get_posts(
	array(
		'post_type'      => 'greatjob_review',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

if ( ! $reviews ) {
	return;
}
?>
<section class="section reviews" id="reviews">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
	</div>

	<div class="reviews__slider swiper" aria-label="<?php echo esc_attr( get_sub_field( 'title' ) ); ?>">
		<div class="swiper-wrapper">
			<?php foreach ( $reviews as $review ) : ?>
				<?php
				$rating = (int) ( get_field( 'rating', $review->ID ) ?: 5 );
				$rating = max( 0, min( 5, $rating ) );
				?>
				<article class="swiper-slide review-card">
					<div class="review-card__content">
						<img class="review-card__quote" src="<?php echo esc_url( $assets . '/quote.svg' ); ?>" alt="" aria-hidden="true">
						<div class="review-card__copy">
							<h3 class="review-card__title"><?php echo esc_html( get_the_title( $review ) ); ?></h3>
							<p class="review-card__text"><?php echo esc_html( get_field( 'body', $review->ID ) ); ?></p>
						</div>
					</div>
					<div class="review-card__meta">
						<div class="review-card__author">
							<img class="review-card__author-line" src="<?php echo esc_url( $assets . '/author-line-32.svg' ); ?>" alt="" aria-hidden="true">
							<span><?php echo esc_html( get_field( 'author', $review->ID ) ); ?></span>
						</div>
						<svg class="review-card__stars" width="120" height="24" viewBox="0 0 120 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="<?php echo esc_attr( $rating ); ?> из 5">
							<?php for ( $i = 0; $i < 5; $i++ ) : ?>
								<path transform="translate(<?php echo esc_attr( $i * 24 ); ?> 0)" d="M11.0489 2.92705C11.3483 2.00574 12.6517 2.00574 12.9511 2.92705L14.4697 7.60081C14.6035 8.01284 14.9875 8.2918 15.4207 8.2918H20.335C21.3037 8.2918 21.7065 9.53141 20.9228 10.1008L16.947 12.9894C16.5966 13.244 16.4499 13.6954 16.5838 14.1074L18.1024 18.7812C18.4017 19.7025 17.3472 20.4686 16.5635 19.8992L12.5878 17.0106C12.2373 16.756 11.7627 16.756 11.4122 17.0106L7.43648 19.8992C6.65276 20.4686 5.59828 19.7025 5.89763 18.7812L7.41623 14.1074C7.5501 13.6954 7.40345 13.244 7.05296 12.9894L3.07722 10.1008C2.29351 9.53141 2.69628 8.2918 3.66501 8.2918H8.57929C9.01252 8.2918 9.39647 8.01284 9.53035 7.60081L11.0489 2.92705Z" fill="<?php echo $i < $rating ? '#FFCA00' : '#DDE8EB'; ?>"/>
							<?php endfor; ?>
						</svg>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="reviews__controls">
		<button class="reviews__button reviews__button--prev" type="button" aria-label="Предыдущий отзыв">
			<img class="reviews__button-icon" src="<?php echo esc_url( $assets . '/arrow-left.svg' ); ?>" alt="" aria-hidden="true">
		</button>
		<button class="reviews__button reviews__button--next" type="button" aria-label="Следующий отзыв">
			<img class="reviews__button-icon" src="<?php echo esc_url( $assets . '/arrow-right.svg' ); ?>" alt="" aria-hidden="true">
		</button>
	</div>
</section>
