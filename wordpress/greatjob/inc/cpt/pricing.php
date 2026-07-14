<?php
/**
 * Custom post type: Pricing plan.
 *
 * Cards for the homepage "Тарифы" section. No single/archive template —
 * each post is only ever rendered as a card inside that section.
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
			'greatjob_pricing',
			array(
				'labels'       => array(
					'name'          => 'Тарифы',
					'singular_name' => 'Тариф',
					'menu_name'     => 'Тарифы',
					'add_new_item'  => 'Добавить тариф',
					'edit_item'     => 'Редактировать тариф',
					'all_items'     => 'Все тарифы',
					'search_items'  => 'Найти тариф',
					'not_found'     => 'Тарифы не найдены',
				),
				'public'       => false,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'has_archive'  => false,
				'rewrite'      => false,
				'query_var'    => false,
				'menu_icon'    => 'dashicons-money-alt',
				'supports'     => array( 'title', 'page-attributes' ),
			)
		);
	}
);
