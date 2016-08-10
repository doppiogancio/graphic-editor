<?php

/**
 * Created by PhpStorm.
 * User: fabriziogargiulo
 * Date: 09/08/16
 * Time: 20:16
 */
class GraphicEditor {

	protected $graphics = array();

	public function __construct() {
		$this->shapes = array();
	}

	static public function factoryGraphic($shape, $settings) {

		// TODO: renderlo universale, magari con concatenazione di stringhe, camel case, etc..
		// TODO: ad ogni modo bisogna sempre controllare che esista la determinata classe, in caso contrario lanciare la GraphicNotFoundException
		switch ($shape) {
			case 'ellipse':
				return new GraphicEllipse($settings);

			case 'circle':
				return new GraphicCircle($settings);

			case 'rectangle':
				return new GraphicRectangle($settings);

			case 'square':
				return new GraphicSquare($settings);

			default:
				throw new GraphicNotFoundException(sprintf("Graphic '%s' not found", $shape));
		}
	}

	public function addGraphic(Graphic $graphic) {
		$this->graphics[] = $graphic;
		return $this;
	}

	public function loadFromArray($array_of_graphics) {
		foreach ($array_of_graphics as $shape => $settings) {
			$graphic = self::factoryGraphic($shape, $settings);
			$this->addGraphic($graphic);
		}

		return $this;
	}

	public function saveJPG($name) {

	}

	public function savePNG($name) {

	}

}