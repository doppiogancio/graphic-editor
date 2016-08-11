Graphic Editor
=========================

*By Fabrizio Gargiulo as exercise

Overview
--------

This class let you create an image using a list of shapes. You will be able to use it also via command line.

```php
<?php

require_once "lib/autoloader.php";

$graphic_editor = new GraphicEditor();

try {
	$graphic_editor->loadSettings([
		'width' => 500,
		'height' => 500,
		'background_color' => [00, 100, 255],
		'shapes' => [
			'circle' => [
				'left' => 200,
				'top' => 150,
				'width' => 300,
				'height' => 255,
				'filler_color' => [55, 0, 255]
			],
			'square' => [
				'left' => 0,
				'top' => 0,
				'width' => 50,
				'filler_color' => [255, 0, 255],
				'border' => ['color' => [255, 255, 255]]
			],
			'ellipse' => [
				'left' => 300,
				'top' => 200,
				'width' => 50,
				'height' => 10,
				'filler_color' => [255, 0, 0],
				'border' => ['color' => [55, 255, 255]]
			]
		]
	]);
}
catch (Exception $e) {
	die($e->getMessage());
}

$graphic_editor->savePNG("a_name");
```