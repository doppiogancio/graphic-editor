<?php

/**
 * Class GraphicEditor
 */
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
			$graphic->draw($this);
		}
	}

	/**
	 * Add a new graphic shape to the image
	 * @param Graphic $graphic
	 * @return $this
	 */
	public function addGraphic( Graphic $graphic ) {
		$this->graphics[] = $graphic;
		return $this;
	}

	/**
	 * Set the background color to the image using an array in RGB format
	 * @param array $rgb_color
	 */
	public function setBackgroundColor( array $rgb_color ) {
		// fill the background color
		$background_color = imagecolorallocate($this->image, $rgb_color[0], $rgb_color[1], $rgb_color[2]);
		imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $background_color);
	}

	/**
	 * Load all image and shapes settings at once using an object
	 * @param $settings
	 *
	 * @return $this
	 * @throws GraphicNotFoundException
	 * @throws SettingRequiredException
	 */
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

	/**
	 * Get image resource
	 * @return mixed
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Save as JPG
	 * @param $name
	 */
	public function saveJPG( $name ) {

		$this->draw();
		imagejpg( $this->image, $name );
	}

	/**
	 * Save as PNG
	 * @param $name
	 */
	public function savePNG( $name ) {

		$this->draw();
		imagepng( $this->image, $name );
	}

	/**
	 * Save this image passing type and name
	 * @param $file_type
	 * @param $name
	 *
	 * @throws FileTypeNotSupportedException
	 */
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