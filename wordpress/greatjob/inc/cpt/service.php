<?php
/**
 * Custom post type: Service.
 *
 * Unlike Reviews/Pricing, each service has its own public single page —
 * the homepage grid card links to it, and the archive reuses the same
 * grid partial between header/footer.
 *
 * @package GreatJob
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'init',
	function () {
		register_post_type(
			'greatjob_service',
			array(
				'labels'       => array(
					'name'          => 'Услуги',
					'singular_name' => 'Услуга',
					'menu_name'     => 'Услуги',
					'add_new_item'  => 'Добавить услугу',
					'edit_item'     => 'Редактировать услугу',
					'all_items'     => 'Все услуги',
					'search_items'  => 'Найти услугу',
					'not_found'     => 'Услуги не найдены',
				),
				'public'       => true,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'has_archive'  => 'services',
				'rewrite'      => array(
					'slug'       => 'services',
					'with_front' => false,
				),
				'query_var'    => true,
				'menu_icon'    => 'dashicons-list-view',
				'supports'     => array( 'title', 'editor', 'page-attributes' ),
			)
		);
	}
);
