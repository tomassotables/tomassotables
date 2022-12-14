<?php

namespace App\Models\widget;

use Timber\Timber;

/**
 * Class Base
 *
 * Handle the Widget registration
 *
 * @package App\Models\Widget
 */
abstract class Base extends \WP_Widget {
	/**
	 * @var array
	 */
	public $context;

	/**
	 * @var string
	 */
	public $id;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var array
	 */
	public $fieldNames = [];

	/**
	 * @var array
	 */
	public $widget_options = [];

	/**
	 * @var array
	 */
	public $control_options = [];

	/**
	 * @var string
	 */
	public $componentName;

	/**
	 * Base constructor
	 */
	final public function __construct() {
		try {
			if ( ! isset( $this->id ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $id' );
			}

			if ( ! isset( $this->name ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $name' );
			}

			$this->componentName = $this->id . '-widget';

			add_action( 'widgets_init', [ $this, 'init' ] );

			parent::__construct( $this->id, $this->name, $this->widget_options, $this->control_options );
		} catch ( \Exception $error ) {
			die( $error );
		}
	}

	/**
	 * Init the Widget
	 *
	 * @return void
	 */
	public function init() {
		register_widget( '\\' . get_class( $this ) );
	}

	/**
	 * Add the context to the widget
	 *
	 * @return void
	 */
	private function addContext() {
		$this->context = \Timber\Timber::get_context();

		$this->context['widget_id'] = $this->id;
		$this->context['widget_name'] = $this->name;

		foreach ( get_fields( 'widget_' . $this->id ) as $fieldName => $value ) {
			$this->context[ $fieldName ] = $value;
		}
	}

	/**
	 * Update the widget parameters
	 *
	 * @since 2.0
	 *
	 * @param array $new_instance The new widget instance
	 * @param array $old_instance The old widget instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Widget admin form
	 *
	 * @since 2.0
	 *
	 * @param array $instance The widget instance
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$title_field_name = 'title';

		echo '<input id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="hidden" value="' . get_field( $title_field_name, 'widget_' . $this->id_base . '-' . $this->number ) . '" />';
		echo '<br />';
	}

	/**
	 * Load the widget HTML
	 *
	 * @since 2.0
	 *
	 * @param array $args     The widget args
	 * @param array $instance The widget instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		// Add context to the widget
		$this->addContext();

		\Timber\Timber::render( 'components/' . $this->componentName . '/' . $this->componentName . '.twig', $this->context );
	}
}
