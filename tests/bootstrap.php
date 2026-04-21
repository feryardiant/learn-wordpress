<?php
/**
 * PHPUnit Bootstrap
 */

$_root = dirname( __DIR__ );

require_once $_root . '/vendor/autoload.php';

// Mock WordPress constants if needed
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', $_root . '/docker/volumes/wordpress/' );
}


defined( 'WP_TESTS_DOMAIN' ) || define( 'WP_TESTS_DOMAIN', '' );
defined( 'WP_TESTS_EMAIL' ) || define( 'WP_TESTS_EMAIL', '' );
defined( 'WP_TESTS_TITLE' ) || define( 'WP_TESTS_TITLE', '' );
defined( 'WP_PHP_BINARY' ) || define( 'WP_PHP_BINARY', '' );


// Any other test initialization can go here.
