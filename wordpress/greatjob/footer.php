<?php
/**
 * The template for displaying the footer.
 *
 * Content comes from the "Footer" ACF options page
 * (Header & Footer > Footer in wp-admin).
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GreatJob
 */

$greatjob_assets     = get_template_directory_uri() . '/assets/images';
$greatjob_copyright  = get_field( 'copyright_text', 'option' ) ?: '© 2026 GreatJob';
$greatjob_columns    = get_field( 'columns', 'option' );
$greatjob_tg_label   = get_field( 'telegram_label', 'option' );
$greatjob_tg_name    = get_field( 'telegram_channel_name', 'option' );
$greatjob_tg_desc    = get_field( 'telegram_channel_description', 'option' );
$greatjob_tg_url     = get_field( 'telegram_url', 'option' );
?>

	<footer class="site-footer">
		<div class="container site-footer__inner">
			<div class="site-footer__brand">
				<a class="site-footer__logo-link" href="#top" aria-label="GreatJob — на главную">
					<img class="site-footer__logo" src="<?php echo esc_url( $greatjob_assets . '/brand-logo.png' ); ?>" alt="GreatJob">
				</a>
				<p class="site-footer__copyright"><?php echo esc_html( $greatjob_copyright ); ?></p>
			</div>

			<?php if ( $greatjob_columns ) : ?>
				<?php foreach ( $greatjob_columns as $greatjob_column ) : ?>
					<nav class="site-footer__nav" aria-label="<?php echo esc_attr( $greatjob_column['label'] ); ?>">
						<strong><?php echo esc_html( $greatjob_column['label'] ); ?></strong>
						<?php if ( ! empty( $greatjob_column['links'] ) ) : ?>
							<div class="site-footer__links">
								<?php foreach ( $greatjob_column['links'] as $greatjob_link ) : ?>
									<a href="<?php echo esc_url( $greatjob_link['url'] ); ?>"><?php echo esc_html( $greatjob_link['label'] ); ?></a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</nav>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if ( $greatjob_tg_name ) : ?>
				<div class="site-footer__channel">
					<?php if ( $greatjob_tg_label ) : ?>
						<p><?php echo esc_html( $greatjob_tg_label ); ?></p>
					<?php endif; ?>
					<p>
						<?php if ( $greatjob_tg_url ) : ?>
							<a href="<?php echo esc_url( $greatjob_tg_url ); ?>" target="_blank" rel="noreferrer"><?php echo esc_html( $greatjob_tg_name ); ?></a>
						<?php else : ?>
							<?php echo esc_html( $greatjob_tg_name ); ?>
						<?php endif; ?>
						<?php if ( $greatjob_tg_desc ) : ?>
							<span><?php echo esc_html( $greatjob_tg_desc ); ?></span>
						<?php endif; ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
