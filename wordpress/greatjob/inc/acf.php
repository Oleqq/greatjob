<?php
/**
 * ACF local JSON sync paths.
 *
 * @package GreatJob
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function greatjob_acf_json_path() {
	return get_template_directory() . '/acf-json';
}

add_filter(
	'acf/settings/save_json',
	function () {
		return greatjob_acf_json_path();
	}
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		$paths[] = greatjob_acf_json_path();
		return $paths;
	}
);
