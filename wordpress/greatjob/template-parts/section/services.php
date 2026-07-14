<?php
/**
 * Services flexible content layout — thin wrapper around the shared
 * services-grid partial, passing this layout's own section title.
 *
 * @package GreatJob
 */

get_template_part( 'template-parts/services-grid', null, array( 'title' => get_sub_field( 'title' ) ) );
