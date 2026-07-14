<?php
/**
 * The header for our theme.
 *
 * Nav/CTA/Telegram link come from the "Header" ACF options page
 * (Header & Footer > Header in wp-admin), not the native WP menu system.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GreatJob
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'greatjob' ); ?></a>

	<?php
	$greatjob_assets      = get_template_directory_uri() . '/assets/images';
	$greatjob_nav_items   = get_field( 'nav_items', 'option' );
	$greatjob_telegram    = get_field( 'telegram_url', 'option' );
	$greatjob_cta_text    = get_field( 'cta_text', 'option' ) ?: 'Связаться с нами';
	$greatjob_cta_url     = get_field( 'cta_url', 'option' ) ?: '#contact';
	?>

	<header class="header">
		<div class="container header__inner">
			<a class="logo" href="#top" aria-label="GreatJob — на главную">
				<img class="logo__mark" src="<?php echo esc_url( $greatjob_assets . '/brand-mark.svg' ); ?>" alt="" aria-hidden="true">
				<span class="logo__text">GreatJob</span>
			</a>

			<?php if ( $greatjob_nav_items ) : ?>
				<nav class="header__nav" aria-label="Основная навигация">
					<?php foreach ( $greatjob_nav_items as $greatjob_item ) : ?>
						<div class="header__nav-item">
							<a class="header__link" href="<?php echo esc_url( $greatjob_item['url'] ); ?>"><?php echo esc_html( $greatjob_item['label'] ); ?></a>
							<?php if ( ! empty( $greatjob_item['sub_items'] ) ) : ?>
								<div class="header__submenu">
									<?php foreach ( $greatjob_item['sub_items'] as $greatjob_sub ) : ?>
										<a class="header__submenu-link" href="<?php echo esc_url( $greatjob_sub['url'] ); ?>"><?php echo esc_html( $greatjob_sub['label'] ); ?></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</nav>
			<?php endif; ?>

			<div class="header__actions">
				<?php if ( $greatjob_telegram ) : ?>
					<a class="icon-button icon-button--telegram" href="<?php echo esc_url( $greatjob_telegram ); ?>" aria-label="Открыть Telegram" target="_blank" rel="noreferrer">
						<img class="icon-button__icon" src="<?php echo esc_url( $greatjob_assets . '/telegram.svg' ); ?>" alt="" aria-hidden="true">
					</a>
				<?php endif; ?>
				<a class="button button--header" href="<?php echo esc_url( $greatjob_cta_url ); ?>"><?php echo esc_html( $greatjob_cta_text ); ?></a>
			</div>

			<button class="header__burger" type="button" aria-expanded="false" aria-controls="header-menu" aria-label="Открыть меню">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>

		<div class="header-menu" id="header-menu" aria-hidden="true">
			<div class="header-menu__top">
				<a class="logo" href="#top" aria-label="GreatJob — на главную">
					<img class="logo__mark" src="<?php echo esc_url( $greatjob_assets . '/brand-mark.svg' ); ?>" alt="" aria-hidden="true">
					<span class="logo__text">GreatJob</span>
				</a>
				<button class="header-menu__close" type="button" aria-label="Закрыть меню">
					<span></span>
					<span></span>
				</button>
			</div>
			<div class="header-menu__body">
				<nav class="header-menu__nav" aria-label="Мобильная навигация">
					<?php foreach ( (array) $greatjob_nav_items as $greatjob_item ) : ?>
						<div class="header-menu__item">
							<a class="header-menu__link" href="<?php echo esc_url( $greatjob_item['url'] ); ?>"><?php echo esc_html( $greatjob_item['label'] ); ?></a>
							<?php if ( ! empty( $greatjob_item['sub_items'] ) ) : ?>
								<div class="header-menu__submenu">
									<?php foreach ( $greatjob_item['sub_items'] as $greatjob_sub ) : ?>
										<a class="header-menu__submenu-link" href="<?php echo esc_url( $greatjob_sub['url'] ); ?>"><?php echo esc_html( $greatjob_sub['label'] ); ?></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
					<a class="button button--header-menu" href="<?php echo esc_url( $greatjob_cta_url ); ?>"><?php echo esc_html( $greatjob_cta_text ); ?></a>
				</nav>
			</div>
		</div>
	</header><!-- .header -->