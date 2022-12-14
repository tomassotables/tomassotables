<?php

namespace App;

/**
 * Class Bootstrap
 *
 * The bootstrap class
 *
 * @package App
 */
class Bootstrap {
	/**
	 * Initialize the App
	 *
	 * @return \App\Bootstrap
	 */
	public function initialize() {
		return $this
			->backend()
			->frontend()
			->licenses()
			->plugins()
			->twig()
			->start();
	}

	/**
	 * Initialize backend logic
	 *
	 * @return $this
	 */
	private function backend() {
		new \App\Hooks\Backend;
		new \App\Hooks\Backend\AdvancedCustomFields;
		new \App\Hooks\Backend\Editor;
		new \App\Hooks\Backend\Options;
		new \App\Hooks\Backend\Placeholders;
		new \App\Hooks\Backend\Trackbacks;

		return $this;
	}

	/**
	 * Initialize frontend logic
	 *
	 * @return $this
	 */
	private function frontend() {
		new \App\Hooks\Frontend;
		new \App\Hooks\Frontend\Excerpt;
		new \App\Hooks\Frontend\Images;
		new \App\Hooks\Frontend\NavMenu;
		new \App\Hooks\Frontend\Search;

		return $this;
	}

	/**
	 * Initialize license logic
	 *
	 * @return $this
	 */
	public function licenses() {
		new \App\Hooks\Licenses\AdvancedCustomFieldsPro;
		new \App\Hooks\Licenses\GravityForms;
		new \App\Hooks\Licenses\UserRoleEditorPro;

		return $this;
	}

	/**
	 * Initialize plugin logic
	 *
	 * @return $this
	 */
	public function plugins() {
		new \App\Hooks\Plugins\GravityForms;
		new \App\Hooks\Plugins\VisualComposer;
		new \App\Hooks\Plugins\WooCommerce;

		return $this;
	}

	/**
	 * Initialize Twig logic
	 *
	 * @return $this
	 */
	public function twig() {
		new \App\Hooks\Twig;
		new \App\Hooks\Twig\Filters;

		return $this;
	}

	/**
	 * Start the App
	 *
	 * @return $this
	 */
	public function start() {
		new \App\Hooks\App();

		return $this;
	}
}
