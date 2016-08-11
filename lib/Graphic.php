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

		// TODO: renderlo universale, magari con concatenazione di stringhe, camel case, etc..
		// TODO: ad ogni modo bisogna sempre controllare che esista la determinata classe, in caso contrario lanciare la GraphicNotFoundException
		switch ( $shape ) {
			case 'ellipse':
				return new GraphicEllipse( $settings );

			case 'circle':
				return new GraphicCircle( $settings );

			case 'rectangle':
				return new GraphicRectangle( $settings );

			case 'square':
				return new GraphicSquare( $settings );

			default:
				throw new GraphicNotFoundException( sprintf( "Graphic '%s' not found", $shape ) );
		}
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