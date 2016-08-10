<?php

require_once "lib/Exceptions.php";
require_once "lib/Graphic.php";
require_once "lib/GraphicEllipse.php";
require_once "lib/GraphicCircle.php";
require_once "lib/GraphicRectangle.php";
require_once "lib/GraphicSquare.php";
require_once "lib/GraphicEditor.php";

$graphic_editor = new GraphicEditor();

$graphic_editor->loadFromArray(array(
	'circle' => array(),
));