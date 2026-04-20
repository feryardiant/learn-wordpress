<?php
/**
 * PHPUnit Bootstrap
 */

require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// Mock WordPress constants if needed
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __DIR__ ) . '/docker/volumes/wordpress/' );
}

// Any other test initialization can go here.
