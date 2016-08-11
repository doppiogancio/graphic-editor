Graphic Editor
=========================

By Fabrizio Gargiulo as exercise

Overview
--------

This class let you create an image using a list of shapes. You will be able to use it also via command line.

# Command line
```php
php -f index.php '{"width":500,"height":500,"background_color":[0,100,255],"save_as":{"file_type":"png","file_name":"from_json.png"},"shapes":[{"type":"circle","left":200,"top":150,"width":300,"height":255,"filler_color":[0,255,255]},{"type":"square","left":0,"top":0,"width":50,"filler_color":[255,0,255],"border":{"color":[10,10,255]}},{"type":"ellipse","left":300,"top":200,"width":50,"height":10,"filler_color":[255,0,0],"border":{"color":[55,255,255]}},{"type":"polygon","filler_color":[255,255,0],"points":[[250,0],[500,500],[0,500]]}]}'
```

# Programmatically with settings array
```php
<?php

require_once "lib/autoloader.php";

$graphic_editor = new GraphicEditor();

$settings = (object) [
	'width' => 500,
	'height' => 500,
	'background_color' => [00, 100, 255],
	'save_as' => (object) [
		'file_type' => 'png',
		'file_name' => 'generated_image_todo.png',
	],
	'shapes' => []
];

// Adding a Circle
$settings->shapes[] = (object) [
	'type' => 'circle',
	'left' => 200,
	'top' => 150,
	'width' => 300,
	'height' => 255,
	'filler_color' => [255, 255, 255]
];

// Adding a Square
$settings->shapes[] = (object) [
	'type' => 'square',
	'left' => 0,
	'top' => 0,
	'width' => 50,
	'filler_color' => [255, 0, 255],
	'border' => ['color' => [255, 255, 255]]
];

// Adding an Ellipse
$settings->shapes[] = (object) [
	'type' => 'ellipse',
	'left' => 300,
	'top' => 200,
	'width' => 50,
	'height' => 10,
	'filler_color' => [255, 0, 0],
	'border' => ['color' => [55, 255, 255]]
];

// Adding a Polygon
$settings->shapes[] = (object) [
	'type' => 'polygon',
	'filler_color' => [255, 255, 0 ],
	'points' => [ [250, 0], [500, 500], [0, 500] ]
];

try {
    if ( empty($settings->save_as) ) {
		throw new SettingRequiredException("save_as attribute is required to generate an image!");
	}

	if ( empty($settings->save_as->file_type) ) {
		throw new SettingRequiredException("save_as/file_type attribute is required to generate an image!");
	}

	if ( empty($settings->save_as->file_name) ) {
		throw new SettingRequiredException("save_as/file_name attribute is required to generate an image!");
	}

	// Load all settings at once
    $graphic_editor->loadSettings($settings);

    // Create and save the image file as defined in the $settings array
    $graphic_editor->save( $settings->save_as->file_type, $settings->save_as->file_name );
}
catch (Exception $e) {
	die($e->getMessage());
}

$graphic_editor->savePNG("a_name");
```