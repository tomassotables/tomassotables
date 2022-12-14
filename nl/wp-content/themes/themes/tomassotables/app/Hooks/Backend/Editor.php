<?php

namespace App\Hooks\Backend;

/**
 * Class Editor
 *
 * Handle the Gutenberg editor logic
 *
 * @since   5.0.0
 *
 * @package App\Hooks\Backend
 */
class Editor extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueueBlockEditorAssets' ] );
		add_action( 'acf/init', [ $this, 'registerBlockTypes' ] );
		add_filter( 'allowed_block_types', [ $this, 'allowedBlockTypes' ] );
	}

	/**
	 * Handle the allowed editor blocks
	 *
	 * @return array
	 */
	public function allowedBlockTypes() {
		$allowedBlocks = $this->editor->allowedBlocks;

		foreach ( $this->editor->components as $component ) {
			$allowedBlocks[] = 'acf/' . strtolower( $component['name'] );
		}

		return $allowedBlocks;
	}

	/**
	 * Enqueue the block editor assets
	 *
	 * @return void
	 */
	public function enqueueBlockEditorAssets() {
		wp_enqueue_style( 'editor', $this->assets->uri( 'editor.css' ), [], null );
	}

	/**
	 * Register the Gutenberg blocks
	 *
	 * @return void
	 */
	public function registerBlockTypes() {
		$block = [
			'category' => 'formatting',
			'icon'     => 'admin-comments',
			'mode'     => 'auto',
			'align'    => 'full',
			'supports' => [
				'align' => false,
			],
		];

		foreach ( $this->editor->components as $component ) {
			acf_register_block_type( array_merge( $block, $component, [
				'render_callback' => [ $this, 'blockOutput' ],
			] ) );
		}
	}

	/**
	 * Render the editor blocks in Timber
	 *
	 * @param $block
	 *
	 * @return void
	 */
	public function blockOutput( $block ) {
		$blockName = str_replace( 'acf/', '', $block['name'] );
		$component = $this->findComponent( $blockName );

		if ( $component ) {
			$acfBlock = $this->parseAcfBlock( $block );
			$context = \Timber\Timber::get_context();
			$context = array_merge( $context, $acfBlock['data'], [
				'id'         => $block['id'],
				'class_name' => ( isset( $block['className'] ) ) ? $block['className'] : null,
			] );

			if ( ! $this->isRest() ) {
				\Timber\Timber::render( 'components/' . $component['name'], $context );
			}
		}
	}

	/**
	 * Parse ACF block data
	 *
	 * @param $block
	 *
	 * @return mixed
	 */
	private function parseAcfBlock( $block ) {
		if ( is_array( $block['data'] ) ) {
			acf_setup_meta( $block['data'], $block['id'], true );

			$fields = get_fields();

			if ( is_array( $fields ) ) {
				$block['data'] = array_merge( $block['data'], $fields );
			}

			acf_reset_meta( $block['id'] );
		}

		return $block;
	}

	/**
	 * Find the correct component by block name
	 *
	 * @param $blockName
	 *
	 * @return bool|mixed
	 */
	private function findComponent( $blockName ) {
		$foundComponent = false;

		foreach ( $this->editor->components as $component ) {
			if ( strtolower( $component['name'] ) === $blockName ) {
				$foundComponent = $component;

				break;
			}
		}

		return $foundComponent;
	}
}
