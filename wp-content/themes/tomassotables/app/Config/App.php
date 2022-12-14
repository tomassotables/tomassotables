<?php

namespace App\Config;

/**
 * Class App
 *
 * The App config
 *
 * @since      5.0
 *
 * @package    App\Config
 */
class App {
	public $themeName;
	public $manifest;
	public $distFolder;
	public $featuredImage;
	public $disableTrackbacks;
	public $contentWidth;
	public $excerpt;
	public $imageSizes;
	public $menus;
	public $search;
	public $editorBlogPage;
	public $hideDefaultEditor;
	public $sidebars;
	public $removedWidgets;

	/**
	 * App constructor
	 */
	public function __construct() {
		$themeNameParts = explode( '/', get_template_directory() );

		/**
		 * Theme name declaration
		 * Will be filled automatic when false
		 *
		 * @since 1.0
		 */
		$this->themeName = end( $themeNameParts );

		/**
		 * Name of the manifest
		 *
		 * @since 5.0
		 */
		$this->manifest = 'manifest.json';

		/**
		 * Path to the dist folder of the theme
		 *
		 * @since 5.0
		 */
		$this->distFolder = '/dist';

		/**
		 * The Timezone of the theme
		 *
		 * @since 5.0
		 */
		$this->timezone = 'Europe/Amsterdam';

		/**
		 * Does the theme make use of the default featured image
		 *
		 * @since 1.0
		 */
		$this->featuredImage = true;

		/**
		 * Does this theme make use of trackbacks?
		 *
		 * @since 3.4.6
		 */
		$this->disableTrackbacks = true;

		/**
		 * Defines the size of the content container
		 *
		 * @since 1.0
		 */
		$this->contentWidth = 1250;

		/**
		 * Defines excerpt options
		 *
		 * @since 1.0
		 */
		$this->excerpt = (object) [
			'ellipsis' => '...',
			'length'   => 20,
		];

		/**
		 * Object containing image sizes for the theme
		 *
		 * @since 3.0
		 */
		$this->imageSizes = (object) [
			'teaser'       => [ 250, 100, true ],
			'blog_archive' => [ 1440, 378, true ],
		];

		/**
		 * Array containing the theme menu locations
		 *
		 * @since 2.0
		 */
		$this->menus = (array) [
			'headerMenu'   => __( 'Header Menu' ),
			'companyMenu'  => __( 'Company Menu' ),
			'usefulMenu'   => __( 'Useful Menu' ),
			'footerMenu'   => __( 'Footer Menu' ),
			'customerMenu' => __( 'Customer Menu' ),
		];

		/**
		 * Redirects search results from /?s=query to /search/query/, converts %20 to +
		 *
		 * @since 3.4.6
		 */
		$this->search = (object) [
			'niceUrl' => true,
			'urlBase' => 'search',
		];

		/**
		 * Show an editor on the blog page in the backend
		 *
		 * @since 2.0
		 */
		$this->editorBlogPage = false;

		/**
		 * Hide the default editor on specified page templates
		 *
		 * @since 2.0
		 */
		$this->hideDefaultEditor = [ 'templates/template-no-editor.php' ];

		/**
		 * Array containing the theme sidebars
		 *
		 * @since 1.0
		 */
		$this->sidebars = (array) [
			[
				'name'          => __( 'Filter Sidebar' ),
				'id'            => 'filter_sidebar',
				'before_widget' => '<div id="%s" class="filter__widget %s">',
				'after_widget'  => '</div>',
				'before_title'  => '<p class="filter__widget-title">',
				'after_title'   => '</p>',
			],
		];

		/**
		 * Remove unused widgets from the theme
		 *
		 * @since 2.0
		 */
		$this->removedWidgets = (array) [
			'WP_Widget_Pages',
			'WP_Widget_Calendar',
			'WP_Widget_Links',
			'WP_Widget_Meta',
			'WP_Widget_Recent_Posts',
			'WP_Widget_Recent_Comments',
			'WP_Widget_RSS',
			'WP_Widget_Tag_Cloud',
		];
	}
}
