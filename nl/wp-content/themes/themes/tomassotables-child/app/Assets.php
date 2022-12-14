<?php
die('dd');
namespace App;

/**
 * Class Assets
 *
 * This classes handles the assets including
 *
 * @since   5.0.0
 *
 * @package App
 */
class Assets {
	/**
	 * @var object The app config
	 */
	private $config;

	/**
	 * @var mixed The app manifest
	 */
	private $manifest;

	/**
	 * Assets constructor
	 *
	 * @param $config
	 */
	public function __construct( $config ) {
		$this->config = $config;
		$this->manifest = json_decode( file_get_contents( get_template_directory() . $this->config->distFolder . '/' . $this->config->manifest ), true );
	}

	/**
	 * Get the assets manifest
	 *
	 * @return mixed
	 */
	public function get() {
		return $this->manifest;
	}

	/**
	 * Get a specific asset uri
	 *
	 * @param null $key
	 *
	 * @return mixed|string
	 */
	public function uri( $key = null ) {
		if ( isset( $this->manifest[ $key ] ) ) {
			$template_path = get_template_directory_uri();
			$template_path = parse_url( $template_path, PHP_URL_PATH );
			$file = str_replace( $template_path . '/dist/', '', $this->manifest[ $key ] );
			$uri = get_template_directory_uri() . $this->config->distFolder . '/' . $file;
			$uri = str_replace( '//wp-content/themes/' . wp_get_theme() . '/dist//wp-content/themes/' . wp_get_theme() . '/dist/', '/wp-content/themes/' . wp_get_theme() . '/dist/', $uri );

			return $uri;
		}

		return false;
	}

	/**
	 * Get the content of a specific asset
	 *
	 * @param null $key
	 *
	 * @return false|string
	 */
	public function contents( $key = null ) {
		$template_path = get_template_directory_uri();
		$template_path = parse_url( $template_path, PHP_URL_PATH );
		$file = str_replace( $template_path . '/dist/', '', $this->config->manifest );
		$contents = get_theme_file_path( $this->config->distFolder . '/' . $file );

		if ( isset( $this->manifest[ $key ] ) ) {
			$file = str_replace( $template_path . '/dist/', '', $this->manifest[ $key ] );
			$contents = get_theme_file_path( $this->config->distFolder . '/' . $file );
		}

		return file_get_contents( $contents );
	}
}
