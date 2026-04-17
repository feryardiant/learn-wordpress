<?php
/**
 * @package feryardiant/wpcf7-entry-manager
 * @copyright Copyright (c) 2026 Fery Wardiyanto <https://feryardiant.id>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 */

namespace CF7_EntryManager;

use WPCF7_HTMLFormatter;

/**
 * Page_Element class.
 *
 * This class provides a fluent interface for generating HTML elements using WPCF7_HTMLFormatter.
 *
 * // Grouping & Text
 * @method static div(array $atts = [], callable|string $child = null)
 * @method static p(array $atts = [], callable|string $child = null)
 * @method static span(array $atts = [], callable|string $child = null)
 * @method static br(array $atts = [])
 * @method static wbr(array $atts = [])
 * @method static hr(array $atts = [])
 *
 * // Sectioning
 * @method static article(array $atts = [], callable|string $child = null)
 * @method static section(array $atts = [], callable|string $child = null)
 * @method static nav(array $atts = [], callable|string $child = null)
 * @method static aside(array $atts = [], callable|string $child = null)
 * @method static header(array $atts = [], callable|string $child = null)
 * @method static footer(array $atts = [], callable|string $child = null)
 * @method static main(array $atts = [], callable|string $child = null)
 * @method static address(array $atts = [], callable|string $child = null)
 * @method static h1(array $atts = [], callable|string $child = null)
 * @method static h2(array $atts = [], callable|string $child = null)
 * @method static h3(array $atts = [], callable|string $child = null)
 * @method static h4(array $atts = [], callable|string $child = null)
 * @method static h5(array $atts = [], callable|string $child = null)
 * @method static h6(array $atts = [], callable|string $child = null)
 * @method static hgroup(array $atts = [], callable|string $child = null)
 *
 * // Lists
 * @method static ul(array $atts = [], callable|string $child = null)
 * @method static ol(array $atts = [], callable|string $child = null)
 * @method static menu(array $atts = [], callable|string $child = null)
 * @method static li(array $atts = [], callable|string $child = null)
 * @method static dl(array $atts = [], callable|string $child = null)
 * @method static dt(array $atts = [], callable|string $child = null)
 * @method static dd(array $atts = [], callable|string $child = null)
 *
 * // Tables
 * @method static table(array $atts = [], callable|string $child = null)
 * @method static caption(array $atts = [], callable|string $child = null)
 * @method static colgroup(array $atts = [], callable|string $child = null)
 * @method static col(array $atts = [])
 * @method static thead(array $atts = [], callable|string $child = null)
 * @method static tbody(array $atts = [], callable|string $child = null)
 * @method static tfoot(array $atts = [], callable|string $child = null)
 * @method static tr(array $atts = [], callable|string $child = null)
 * @method static th(array $atts = [], callable|string $child = null)
 * @method static td(array $atts = [], callable|string $child = null)
 *
 * // Forms
 * @method static form(array $atts = [], callable|string $child = null)
 * @method static fieldset(array $atts = [], callable|string $child = null)
 * @method static legend(array $atts = [], callable|string $child = null)
 * @method static label(array $atts = [], callable|string $child = null)
 * @method static input(array $atts = [])
 * @method static button(array $atts = [], callable|string $child = null)
 * @method static select(array $atts = [], callable|string $child = null)
 * @method static optgroup(array $atts = [], callable|string $child = null)
 * @method static option(array $atts = [], callable|string $child = null)
 * @method static textarea(array $atts = [], callable|string $child = null)
 * @method static datalist(array $atts = [], callable|string $child = null)
 * @method static output(array $atts = [], callable|string $child = null)
 * @method static progress(array $atts = [], callable|string $child = null)
 * @method static meter(array $atts = [], callable|string $child = null)
 *
 * // Inline Formatting
 * @method static a(array $atts = [], callable|string $child = null)
 * @method static strong(array $atts = [], callable|string $child = null)
 * @method static b(array $atts = [], callable|string $child = null)
 * @method static em(array $atts = [], callable|string $child = null)
 * @method static i(array $atts = [], callable|string $child = null)
 * @method static u(array $atts = [], callable|string $child = null)
 * @method static s(array $atts = [], callable|string $child = null)
 * @method static small(array $atts = [], callable|string $child = null)
 * @method static mark(array $atts = [], callable|string $child = null)
 * @method static sub(array $atts = [], callable|string $child = null)
 * @method static sup(array $atts = [], callable|string $child = null)
 * @method static abbr(array $atts = [], callable|string $child = null)
 * @method static dfn(array $atts = [], callable|string $child = null)
 * @method static cite(array $atts = [], callable|string $child = null)
 * @method static q(array $atts = [], callable|string $child = null)
 * @method static ruby(array $atts = [], callable|string $child = null)
 * @method static rt(array $atts = [], callable|string $child = null)
 * @method static rp(array $atts = [], callable|string $child = null)
 *
 * // Inline Tech & Data
 * @method static data(array $atts = [], callable|string $child = null)
 * @method static time(array $atts = [], callable|string $child = null)
 * @method static code(array $atts = [], callable|string $child = null)
 * @method static kbd(array $atts = [], callable|string $child = null)
 * @method static samp(array $atts = [], callable|string $child = null)
 * @method static var(array $atts = [], callable|string $child = null)
 * @method static bdi(array $atts = [], callable|string $child = null)
 * @method static bdo(array $atts = [], callable|string $child = null)
 * @method static ins(array $atts = [], callable|string $child = null)
 * @method static del(array $atts = [], callable|string $child = null)
 *
 * // Figures & Interactive
 * @method static figure(array $atts = [], callable|string $child = null)
 * @method static figcaption(array $atts = [], callable|string $child = null)
 * @method static details(array $atts = [], callable|string $child = null)
 * @method static summary(array $atts = [], callable|string $child = null)
 * @method static dialog(array $atts = [], callable|string $child = null)
 *
 * // Media & Embedded
 * @method static img(array $atts = [])
 * @method static picture(array $atts = [], callable|string $child = null)
 * @method static video(array $atts = [], callable|string $child = null)
 * @method static audio(array $atts = [], callable|string $child = null)
 * @method static source(array $atts = [])
 * @method static track(array $atts = [])
 * @method static iframe(array $atts = [], callable|string $child = null)
 * @method static canvas(array $atts = [], callable|string $child = null)
 * @method static map(array $atts = [], callable|string $child = null)
 * @method static area(array $atts = [])
 * @method static object(array $atts = [], callable|string $child = null)
 * @method static param(array $atts = [])
 * @method static embed(array $atts = [])
 *
 * // Miscellaneous
 * @method static pre(array $atts = [], callable|string $child = null)
 * @method static blockquote(array $atts = [], callable|string $child = null)
 * @method static noscript(array $atts = [], callable|string $child = null)
 * @method static template(array $atts = [], callable|string $child = null)
 * @method static slot(array $atts = [], callable|string $child = null)
 * @method static base(array $atts = [])
 */
final class Page_Element {
	private WPCF7_HTMLFormatter $formatter;

	private array $known_elements = array();

	private array $ignored_elements = array(
		WPCF7_HTMLFormatter::placeholder_block,
		WPCF7_HTMLFormatter::placeholder_inline,
		'html', 'head', 'title', 'link', 'meta',
		'body', 'script', 'style', 'keygen'
	);

	private bool $within_element = false;

	public function __construct( array $option ) {
		if ( array_key_exists( 'allowed_html', $option ) ) {
			$option['allowed_html'] = array_merge( wpcf7_kses_allowed_html(), $option['allowed_html'] );
		}

		$this->formatter = new WPCF7_HTMLFormatter( $option );

		$known_elements = array_filter(
			array_merge(
				WPCF7_HTMLFormatter::void_elements,
				WPCF7_HTMLFormatter::p_parent_elements,
				WPCF7_HTMLFormatter::p_nonparent_elements,
				WPCF7_HTMLFormatter::br_parent_elements,
			),
			fn( string $element ) => ! in_array( $element, $this->ignored_elements )
		);

		$this->known_elements = array_unique( $known_elements );
	}

	public function __call( string $method, array $arguments = array() ): static
	{
		if ( ! in_array( $method, $this->known_elements ) ) {
			throw new \BadMethodCallException( sprintf(
				'Call to undefined method: %s::$s()',
				__CLASS__, $method
			) );
		}

		$atts = $arguments[0] ?? array();

		if ( ! is_array( $atts ) ) {
			throw new \TypeError( sprintf(
				'%s::$s(): Argument #1 ($atts) must be of type array, %s given',
				__CLASS__, $method, gettype( $atts )
			) );
		}

		$this->formatter->append_start_tag( $method, $atts );

		if ( in_array( $method, WPCF7_HTMLFormatter::void_elements ) ) {
			return $this;
		}

		if ( isset( $arguments[1] ) && ! empty( $arguments[1] ) ) {
			$child = $arguments[1];

			if ( is_string( $child )) {
				$this->formatter->append_preformatted( $child );
			} elseif ( is_callable( $child ) ) {
				$child_callback = new \ReflectionFunction( $child );

				$this->within_element = true;

				$return = $child_callback->invoke( $this );

				if ( is_string( $return ) ) {
					$this->formatter->append_preformatted( $return );
				}

				$this->within_element = false;
			} else {
				throw new \TypeError( sprintf(
					'%s::$s(): Argument #2 ($child) must be of type callable|string, %s given',
					__CLASS__, $method, gettype( $child )
				) );
			}
		}

		$this->formatter->end_tag( $method );

		return $this;
	}

	public function render(): void {
		if ( $this->within_element ) {
			throw new \LogicException( 'Cannot render within an element' );
		}

		$this->formatter->print();
	}
}
