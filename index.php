<?php

spl_autoload_register(function ($class_name) {
	include "lib/" . $class_name . '.php';
});

$graphic_editor = new GraphicEditor();

$graphic_editor->loadFromArray(array(
	'circle' => array(),
));