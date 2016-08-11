<?php

abstract class Graphic implements iDrawable {

	protected $graphic_editor;
	protected $settings;

	public function __construct($settings) {
		$this->graphic_editor = null;

		$default_settings = array(
			'border' => false,
			'filler_color' => array(255, 255, 255),
		);

		$this->settings = array_merge($default_settings, $settings);
	}

	static public function create( $shape, $settings ) {

		$class_name = sprintf( "Graphic%s", ucfirst($shape) );

		if ( !class_exists($class_name) ) {
			throw new GraphicNotFoundException( sprintf( "Graphic '%s' not found", $shape ) );
		}

		return new $class_name( $settings );
	}

	public function setGraphicEditor(GraphicEditor $graphic_editor) {
		$this->graphic_editor = $graphic_editor;
	}

	public function getGraphicEditor() {
		return $this->graphic_editor;
	}

	public function __get($name) {
		return $this->settings[$name];
	}
}