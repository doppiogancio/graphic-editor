<?php

require_once "lib/autoloader.php";

$graphic_editor = new GraphicEditor();

try {

	if ( empty($argv[1]) ) {
		throw new SettingRequiredException("Settings argument is missing!");
	}

	// Convert argument #1 from a JSON STRING to an
	$settings = json_decode($argv[1]);

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
catch (GraphicNotFoundException $e) {
	// do something...
	die($e->getMessage());
}
catch (Exception $e) {
	// ...do something else
	die($e->getMessage());
}
