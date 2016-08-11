<?php

class GraphicCircle extends GraphicEllipse {

	public function __construct( $settings ) {
		parent::__construct( $settings );

		if ( empty($this->settings->width) ) {
			throw new SettingRequiredException("Width is a required setting for GraphicCircle!");
		}

		$this->settings->height = $this->settings->width;
	}

}