<?php
/**
 * Small shared template helpers.
 *
 * @package GreatJob
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'greatjob_contrast_text_color' ) ) {
	/**
	 * Picks readable black/white text for an arbitrary editor-chosen background color.
	 *
	 * @param string $hex Background color, e.g. "#ffca00".
	 * @return string "#141414" or "#ffffff".
	 */
	function greatjob_contrast_text_color( $hex ) {
		$hex = ltrim( (string) $hex, '#' );

		if ( 6 !== strlen( $hex ) ) {
			return '#141414';
		}

		$r         = hexdec( substr( $hex, 0, 2 ) );
		$g         = hexdec( substr( $hex, 2, 2 ) );
		$b         = hexdec( substr( $hex, 4, 2 ) );
		$luminance = ( 0.299 * $r + 0.587 * $g + 0.114 * $b ) / 255;

		return $luminance > 0.6 ? '#141414' : '#ffffff';
	}
}
