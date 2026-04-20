<?php
/**
 * PHPUnit Bootstrap
 */

$_root = dirname( __DIR__ );

require_once $_root . '/vendor/autoload.php';

// Mock WordPress constants if needed
if ( ! defined( 'ABSPATH' ) ) {

	define(
		'ABSPATH',
		is_dir( $_root . '/docker/volumes/wordpress/' )
			? $_root . '/docker/volumes/wordpress/'
			: $_root . '/tests/stubs/wordpress/'
	);
}

// Any other test initialization can go here.
