<?php

namespace App\Controllers;

/**
 * Class Search
 *
 * Controls the search logic
 *
 * @package App\Controllers
 */
class Search extends Base {
	/**
	 * Search constructor
	 */
	public function __construct() {
		parent::__construct();

		global $wp_query;

		$this->addContext( 'results', $wp_query->found_posts );
	}
}
