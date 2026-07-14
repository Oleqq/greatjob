<?php
/**
 * ACF options pages for header/footer — a parent menu item with two
 * sub-pages (tabs) instead of the native WordPress nav menu system.
 *
 * @package GreatJob
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'acf/init',
	function () {
		if ( ! function_exists( 'acf_add_options_page' ) ) {
			return;
		}

		acf_add_options_page(
			array(
				'page_title' => 'Header & Footer',
				'menu_title' => 'Header & Footer',
				'menu_slug'  => 'greatjob-header-footer',
				'capability' => 'edit_theme_options',
				'icon_url'   => 'dashicons-align-center',
				'redirect'   => true,
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => 'Header',
				'menu_title'  => 'Header',
				'menu_slug'   => 'greatjob-header-options',
				'parent_slug' => 'greatjob-header-footer',
				'capability'  => 'edit_theme_options',
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => 'Footer',
				'menu_title'  => 'Footer',
				'menu_slug'   => 'greatjob-footer-options',
				'parent_slug' => 'greatjob-header-footer',
				'capability'  => 'edit_theme_options',
			)
		);
	}
);
