<?php

require_once "lib/autoloader.php";

$graphic_editor = new GraphicEditor();

$settings = [
	'width' => 500,
	'height' => 500,
	'background_color' => [00, 100, 255],
	'save_as' => [
		'file_type' => 'png',
		'file_name' => 'generated_image.png',
	],
	'shapes' => [
		'circle' => [
			'left' => 200,
			'top' => 150,
			'width' => 300,
			'height' => 255,
			'filler_color' => [255, 255, 255]
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
];

try {

	if ( empty($settings['save_as']) ) {
		throw new SettingRequiredException("save_as attribute is required to generate an image!");
	}

	if ( empty($settings['save_as']['file_type']) ) {
		throw new SettingRequiredException("save_as/file_type attribute is required to generate an image!");
	}

	if ( empty($settings['save_as']['file_name']) ) {
		throw new SettingRequiredException("save_as/file_name attribute is required to generate an image!");
	}

	// Load all settings at once
	$graphic_editor->loadSettings($settings);

	// Create and save the image file as defined in the $settings array
	$graphic_editor->save( $settings['save_as']['file_type'], $settings['save_as']['file_name']);

}
catch (Exception $e) {
	print $e->getMessage();
	die();
}

