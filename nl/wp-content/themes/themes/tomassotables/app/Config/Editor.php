<?php

namespace App\Config;

/**
 * Class Editor
 *
 * The Editor config
 *
 * @since      5.0
 *
 * @package    App\Config
 */
class Editor {
	public $components;

	/**
	 * Editor constructor
	 */
	public function __construct() {
		$this->components = [
			[
				'name'        => 'content',
				'title'       => __( 'Content' ),
				'description' => __( 'Klassieke content' ),
				'icon'        => 'editor-justify',
			],
		];

		$this->allowedBlocks = [
			'gravityforms/form',
			'core/columns',
			'core/column',
			//'core/seperator',
			//'core/paragraph',
			//'core/image',
			//'core/heading',
			//'core/list',
			//'core/gallery',
			//'core/quote',
			//'core/audio',
			//'core/cover',
			//'core/file',
			//'core/video',
			//'core/freedom',
			//'core/code',
			//'core/html',
			//'core/preformatted',
			//'core/pullquote',
			//'core/table',
			//'core/verse',
			//'core/button',
			//'core/group',
			//'core/media-text',
			//'core/more',
			//'core/nextpage',
			//'core/spacer',
			//'core/shortcode',
			//'core/archives',
			//'core/calendar',
			//'core/categories',
			//'core/comments',
			//'core/latest-posts',
			//'core/rss',
			//'core/search',
			//'core/tag-cloud',
			//'core/embed',
			//'core/embed-twitter',
			//'core/embed-youtube',
			//'core/embed-facebook',
			//'core/embed-instagram',
			//'core/embed-wordpress',
			//'core/embed-soundcloud',
			//'core/embed-spotify',
			//'core/embed-flickr',
			//'core/embed-vimeo',
			//'core/embed-animoto',
			//'core/embed-cloudup',
			//'core/embed-crowdsignal',
			//'core/embed-dailymotion',
			//'core/embed-hulu',
			//'core/embed-imgur',
			//'core/embed-issuu',
			//'core/embed-kickstarter',
			//'core/embed-meetup-com',
			//'core/embed-mixcloud',
			//'core/embed-reddit',
			//'core/embed-reverbnation',
			//'core/embed-screencast',
			//'core/embed-scribd',
			//'core/embed-slideshare',
			//'core/embed-spacer',
			//'core/embed-smugmug',
			//'core/embed-speaker-deck',
			//'core/embed-ted',
			//'core/embed-tumbler',
			//'core/embed-videopress',
			//'core/embed-wordpress-tv',
			//'core/embed-amazon-kindle',
		];
	}
}
