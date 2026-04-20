<?php

namespace UnitTests\Custom_Theme;

use UnitTests\BaseTestCase;
use Brain\Monkey\Actions;

/**
 * Class FunctionsTest
 */
class FunctionsTest extends BaseTestCase {
	/**
	 * Test that ct_activation is triggered when after_switch_theme is fired.
	 */
	public function test_ct_activation_triggered_on_after_switch_theme() {
		// 1. Verify action is added
		Actions\expectAdded( 'after_switch_theme' )
			->once()
			->whenHappen(
				function ( $callback ) {
					// 2. Expect ct_activation to be called when the callback runs
					Actions\expectDone( 'ct_activation' )->once();

					// 3. Execute the callback
					$callback();

					$this->addToAssertionCount( 2 ); // add_action and do_action
				}
			);

		// Load the file to trigger add_action calls
		require_once dirname( ABSPATH, 3 ) . '/packages/custom-theme/functions.php';
	}

	/**
	 * Test that ct_deactivation is triggered when switch_theme is fired.
	 */
	public function test_ct_deactivation_triggered_on_switch_theme() {
		// 1. Verify action is added
		Actions\expectAdded( 'switch_theme' )
			->once()
			->whenHappen(
				function ( $callback ) {
					// 2. Expect ct_deactivation to be called when the callback runs
					Actions\expectDone( 'ct_deactivation' )->once();

					// 3. Execute the callback
					$callback();

					$this->addToAssertionCount( 2 ); // add_action and do_action
				}
			);

		// Load the file (it will be loaded again but functions.php doesn't have class/function re-declarations)
		// Actually require_once will skip it if already loaded, but it's fine for this test if we run them together.
		// For proper isolation, we'd use separate test methods and ensure the file is loaded.
		// Since it's all top-level add_action calls, they run on load.
		require dirname( ABSPATH, 3 ) . '/packages/custom-theme/functions.php';
	}
}
