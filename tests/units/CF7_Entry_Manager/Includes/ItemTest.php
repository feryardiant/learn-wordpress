<?php

declare(strict_types=1);

namespace UnitTests\CF7_Entry_Manager\Includes;

use CF7_Entry_Manager\Item;
use PHPUnit\Framework\Attributes\CoversClass;
use UnitTests\CF7_Entry_Manager\TestCase;

/**
 * Class ItemTest
 */
#[CoversClass( Item::class )]
class ItemTest extends TestCase {
	/**
	 * Setup before any test in this class runs.
	 */
	public static function setUpBeforeClass(): void {
		parent::setUpBeforeClass();

		require_once static::package_file( 'cf7-entry-manager/includes/class-item.php' );
	}

	public function test_dummy() {
		$this->assertTrue( class_exists( Item::class ) );
	}
}
