<?php

class GraphicSquare extends GraphicRectangle {

	public function __construct( $settings ) {
		parent::__construct( $settings );

		if ( empty($this->settings['width']) ) {
			throw new SettingRequiredException("Width is a required setting for GraphicSquare!");
		}

		$this->settings['height'] = $this->settings['width'];
	}

}