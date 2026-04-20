<?php

declare(strict_types=1);

namespace UnitTests\CF7_Entry_Manager\Includes;

use CF7_Entry_Manager\Page_Element;
use PHPUnit\Framework\Attributes\CoversClass;
use UnitTests\CF7_Entry_Manager\TestCase;

/**
 * Class PageElementTest
 */
#[CoversClass( Page_Element::class )]
class PageElementTest extends TestCase {
	/**
	 * Setup before any test in this class runs.
	 */
	public static function setUpBeforeClass(): void {
		parent::setUpBeforeClass();

		require_once static::package_file( 'cf7-entry-manager/includes/class-page-element.php' );
	}

	public function test_dummy() {
		$this->assertTrue( class_exists( Page_Element::class ) );
	}
}
