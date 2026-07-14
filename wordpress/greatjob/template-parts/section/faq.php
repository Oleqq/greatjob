<?php
/**
 * FAQ flexible content layout.
 *
 * Two-level repeater: groups (tabs) -> items (accordion). The plus/minus
 * icon is pure CSS (two rotating lines), no image assets involved.
 *
 * @package GreatJob
 */

if ( ! have_rows( 'groups' ) ) {
	return;
}

$groups = array();
while ( have_rows( 'groups' ) ) {
	the_row();
	$groups[] = array(
		'label' => get_sub_field( 'label' ),
		'items' => get_sub_field( 'items' ),
	);
}

if ( ! $groups ) {
	return;
}
?>
<section class="section faq" id="faq">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
		<div class="faq-layout">
			<div class="faq-tabs swiper" role="tablist" aria-label="Категории FAQ">
				<div class="faq-tabs__wrapper swiper-wrapper">
					<?php foreach ( $groups as $index => $group ) : ?>
						<button class="faq-tab swiper-slide<?php echo 0 === $index ? ' is-active' : ''; ?>" id="faq-tab-<?php echo esc_attr( $index ); ?>" type="button" role="tab" aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>" aria-controls="faq-panel-<?php echo esc_attr( $index ); ?>" data-faq-tab="<?php echo esc_attr( $index ); ?>"><?php echo esc_html( $group['label'] ); ?></button>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="faq-panels">
				<?php foreach ( $groups as $index => $group ) : ?>
					<div class="faq-panel" id="faq-panel-<?php echo esc_attr( $index ); ?>" role="tabpanel" aria-labelledby="faq-tab-<?php echo esc_attr( $index ); ?>" data-faq-panel="<?php echo esc_attr( $index ); ?>"<?php echo 0 === $index ? '' : ' hidden'; ?>>
						<?php if ( $group['items'] ) : ?>
							<div class="faq-list">
								<?php foreach ( $group['items'] as $item ) : ?>
									<?php $is_open = ! empty( $item['is_open'] ); ?>
									<article class="faq-item<?php echo $is_open ? ' is-open' : ''; ?>">
										<button class="faq-item__summary" type="button" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
											<span><?php echo esc_html( $item['question'] ); ?></span>
											<span class="faq-item__icons" aria-hidden="true">
												<span class="faq-item__icon-line faq-item__icon-line--horizontal"></span>
												<span class="faq-item__icon-line faq-item__icon-line--vertical"></span>
											</span>
										</button>
										<div class="faq-item__answer">
											<div class="faq-item__answer-inner">
												<p><?php echo esc_html( $item['answer'] ); ?></p>
											</div>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
