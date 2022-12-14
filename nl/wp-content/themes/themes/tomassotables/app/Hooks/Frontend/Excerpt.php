<?php

namespace App\Hooks\Frontend;

/**
 * Class Excerpt
 *
 * Handles all excerpt related hooks
 *
 * @since      2.0
 *
 * @package    App\Hooks\Frontend
 */
class Excerpt extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_filter( 'excerpt_length', [ $this, 'excerptLength' ], 999 );
		add_filter( 'excerpt_more', [ $this, 'excerptMore' ] );
	}

	/**
	 * Adjusts the global excerpt length
	 * Makes use of the `EXCERPT_LENGTH` constant in `functions.php`
	 *
	 * @since    2.0
	 *
	 * @return int The new length for the excerpts
	 * @internal This function is hooked on the `excerpt_length` filter
	 * @link     https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length
	 *
	 */
	public function excerptLength() {
		return $this->config->excerpt->length;
	}

	/**
	 * Adjusts the global excerpt more symbol
	 * Makes use of the `EXCERPT_MORE` constant in the `functions.php`
	 *
	 * @since    2.0
	 *
	 * @return string The new excerpt more symbol
	 * @internal This function is hooked on the `excerpt_more` filter
	 * @link     https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
	 *
	 */
	public function excerptMore() {
		return $this->config->excerpt->ellipsis;
	}
}
