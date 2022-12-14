<?php

namespace App\Controllers;

/**
 * Class NotFound
 *
 * Handles the 404 page
 *
 * @package App\Controllers
 */
class NotFound extends Base {
	/**
	 * NotFound constructor
	 */
	
	public function __construct() {
		parent::__construct();

		// Get the custom 404 page in the post context
		$this->addContext( 'post', $this->getPost( [
			'post_type'  => 'page',
			'meta_key'   => '_wp_page_template',
			'meta_value' => '404',
		] ) );
	}
}
