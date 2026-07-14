<?php
/**
 * Custom post type: Review.
 *
 * Cards for the homepage "Отзывы о нашей работе" section. No single/archive
 * template — each post is only ever rendered as a card inside that section.
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
			'greatjob_review',
			array(
				'labels'       => array(
					'name'          => 'Отзывы',
					'singular_name' => 'Отзыв',
					'menu_name'     => 'Отзывы',
					'add_new_item'  => 'Добавить отзыв',
					'edit_item'     => 'Редактировать отзыв',
					'all_items'     => 'Все отзывы',
					'search_items'  => 'Найти отзыв',
					'not_found'     => 'Отзывы не найдены',
				),
				'public'       => false,
				'show_ui'      => true,
				'show_in_menu' => true,
				'show_in_rest' => true,
				'has_archive'  => false,
				'rewrite'      => false,
				'query_var'    => false,
				'menu_icon'    => 'dashicons-star-filled',
				'supports'     => array( 'title', 'page-attributes' ),
			)
		);
	}
);
