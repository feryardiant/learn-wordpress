<?php
/**
 * PHPUnit Bootstrap
 */

require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// Mock WordPress constants if needed
if ( ! defined( 'ABSPATH' ) ) {
	$_root = dirname( __DIR__ );

	define(
		'ABSPATH',
		is_dir( $_root . '/docker/volumes/wordpress/' )
			? $_root . '/docker/volumes/wordpress/'
			: $_root . '/tests/stubs/wordpress/'
	);
}

// Any other test initialization can go here.
