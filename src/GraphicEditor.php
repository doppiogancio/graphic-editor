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

	protected function _create_image() {
		// create a blank image
		$this->image = imagecreatetruecolor( $this->width, $this->height );
	}

	protected function draw() {
		foreach ($this->graphics as $graphic) {
			$graphic->draw();
		}
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

		if ( empty($settings->width) ) {
			throw new SettingRequiredException("Width is a required setting for GraphicEditor!");
		}

		if ( empty($settings->height) ) {
			throw new SettingRequiredException("Height is a required setting for GraphicEditor!");
		}

		$this->width = $settings->width;
		$this->height = $settings->height;

		// Create again the image
		$this->_create_image();

		if ( !empty($settings->background_color) ) {
			$this->setBackgroundColor($settings->background_color);
		}

		foreach ( $settings->shapes as $settings ) {
			$graphic = Graphic::create( $settings->type, $settings );
			$this->addGraphic( $graphic );
		}

		return $this;
	}

	public function getImage() {
		return $this->image;
	}

	// SAVE FUNCTIONS
	public function saveJPG( $name ) {

		$this->draw();
		imagejpg( $this->image, $name );
	}

	public function savePNG( $name ) {

		$this->draw();
		imagepng( $this->image, $name );
	}

	public function save( $file_type, $name ) {

		switch ( strtolower($file_type) ) {
			case 'png':
				$this->savePNG($name);
				break;

			case 'jpg':
				$this->saveJPG($name);
				break;

			default:
				throw new FileTypeNotSupportedException( sprintf("File type '%s' is not yet supported!" ) );
				break;
		}
	}

}