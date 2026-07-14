<?php
/**
 * Allow SVG uploads in the media library.
 *
 * @package GreatJob
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'upload_mimes',
	function ( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
);

add_filter(
	'wp_check_filetype_and_ext',
	function ( $data, $file, $filename, $mimes ) {
		if ( $data['type'] ) {
			return $data;
		}

		$filetype = wp_check_filetype( $filename, $mimes );

		if ( 'svg' === $filetype['ext'] ) {
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}

		return $data;
	},
	10,
	4
);
