<?php

class GraphicRectangle extends Graphic {
	public function draw() {

		$image = $this->graphic_editor->getImage();

		$filler_color = imagecolorallocate($image, $this->filler_color[0], $this->filler_color[1], $this->filler_color[2]);

		imagefilledrectangle($image, $this->left, $this->top, $this->left + $this->width, $this->top + $this->height, $filler_color);

		if ( isset($this->border['color']) ) {
			// border color
			$border_color = imagecolorallocate($image, $this->border['color'][0], $this->border['color'][1], $this->border['color'][2]);
			imagerectangle($image, $this->left, $this->top, $this->left + $this->width, $this->top + $this->height, $border_color);
		}
	}
}