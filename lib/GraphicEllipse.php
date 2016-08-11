<?php

class GraphicEllipse extends Graphic {

	public function draw() {


		// create a blank image
		$image = $this->graphic_editor->getImage();

		// choose a color for the ellipse
		$col_ellipse = imagecolorallocate($image, $this->filler_color[0], $this->filler_color[1], $this->filler_color[2]);

		// draw the white ellipse
		imagefilledellipse($image, $this->left, $this->top, $this->width, $this->height, $col_ellipse);

		if ( isset($this->border->color) ) {
			// border color
			$border_color = imagecolorallocate($image, $this->border->color[0], $this->border->color[1], $this->border->color[2]);
			imageellipse ( $image, $this->left, $this->top, $this->width, $this->height, $border_color);
		}

	}

}