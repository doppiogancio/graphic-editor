<?php

class GraphicEditor {

	protected $width;
	protected $height;
	protected $graphics;

	protected $image;

	public function __construct() {

		$this->width = 0;
		$this->height = 0;
		$this->graphics = array();
	}

	public function addGraphic( Graphic $graphic ) {

		$graphic->setGraphicEditor($this);
		$this->graphics[] = $graphic;

		return $this;
	}

	public function setBackgroundColor( array $rgb_color ) {
		// fill the background color
		$background_color = imagecolorallocate($this->image, $rgb_color[0], $rgb_color[1], $rgb_color[2]);
		imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $background_color);
	}

	public function loadSettings( $settings ) {

		if ( empty($settings['width']) ) {
			throw new SettingRequiredException("Width is a required setting for GraphicEditor!");
		}

		if ( empty($settings['height']) ) {
			throw new SettingRequiredException("Height is a required setting for GraphicEditor!");
		}

		$this->width = $settings['width'];
		$this->height = $settings['height'];

		// Create again the image
		$this->_create_image();

		if ( !empty($settings['background_color']) ) {
			$this->setBackgroundColor($settings['background_color']);
		}

		foreach ( $settings['shapes'] as $shape => $settings ) {
			$graphic = Graphic::create( $shape, $settings );
			$this->addGraphic( $graphic );
		}

		return $this;
	}

	public function getImage() {
		return $this->image;
	}

	protected function _create_image() {
		// create a blank image
		$this->image = imagecreatetruecolor( $this->width, $this->height );
	}

	protected function draw() {
		foreach ($this->graphics as $graphic) {
			$graphic->draw();
		}
	}

	public function saveJPG( $name ) {
		// TODO: draw su tutte le immagini
	}

	public function savePNG( $name ) {

		$this->draw();

		// output the picture
		header( "Content-type: image/png" );
		imagepng( $this->image );
	}

}