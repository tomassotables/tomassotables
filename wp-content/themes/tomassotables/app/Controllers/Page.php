<?php

namespace App\Controllers;

/**
 * Class Page
 *
 * Controls the page logic
 *
 * @since   5.0.0
 *
 * @package Controllers
 */
class Page extends Base {
	/**
	 * Homepage logic
	 *
	 * @return void
	 */
	public function home() {
		$this->addContext( 'content_section', get_field( 'content_section' ) );
		$this->addContext( 'post', $this->getPost() );

		$this->view( 'page/home' );
	}

	/**
	 * Page logic
	 *
	 * @return void
	 */

	public function page() {
		
		$this->addContext( 'content_section', get_field( 'content_section' ) );
		$this->addContext( 'post', $this->getPost() );

		$this->view( 'page/page' );
	}
	
	/**
	 * Page template specific logic
	 * You can create a file called views/page/templateName.twig
	 * to activate a page template automatically in the admin
	 *
	 * @return void
	 */

	public function customerService() {
		$this->addContext( 'faqs', get_field( 'faqs' ) );
		$this->addContext( 'post', $this->getPost() );
		$this->addContext( 'content_section', get_field( 'content_section' ) );

		$this->view( 'page/customerService' );
	}

	public function account() {
		$this->addContext( 'post', $this->getPost() );
		$this->addContext( 'content_section', get_field( 'content_section' ) );

		$this->view( 'page/account' );
	}
}
