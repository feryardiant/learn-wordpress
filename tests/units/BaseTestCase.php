<?php

namespace UnitTests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Brain\Monkey;

/**
 * Base Test Case for all unit tests.
 */
abstract class BaseTestCase extends PHPUnitTestCase {
	/**
	 * Setup the test environment.
	 */
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Tear down the test environment.
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}
}
