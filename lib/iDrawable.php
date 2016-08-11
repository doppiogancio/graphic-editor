<?php

interface iDrawable {
	public function draw();
	public function setGraphicEditor(GraphicEditor $graphic_editor);
	public function getGraphicEditor();
}