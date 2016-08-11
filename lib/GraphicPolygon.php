<?php

class GraphicPolygon extends Graphic {

	public function __construct( $settings ) {
		parent::__construct( $settings );

		if ( empty($this->settings->points) ) {
			throw new SettingRequiredException("Points are a required setting for GraphicPolygon!");
		}
	}

	protected function _get_points() {

		$points = array();

		foreach ( $this->points as $point ) {
			$points = array_merge($points, $point);
		}

		return $points;
	}

	public function draw() {


		// create a blank image
		$image = $this->graphic_editor->getImage();

		// choose a color for the ellipse
		$filler_color = imagecolorallocate($image, $this->filler_color[0], $this->filler_color[1], $this->filler_color[2]);

		// draw the white ellipse
		imagefilledpolygon($image, $this->_get_points(), count($this->points), $filler_color);

		if ( isset($this->border['color']) ) {
			// border color
			$border_color = imagecolorallocate($image, $this->border['color'][0], $this->border['color'][1], $this->border['color'][2]);
			imagepolygon($image, $this->_get_points(), count($this->points), $filler_color);
		}

	}
}