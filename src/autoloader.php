<?php

spl_autoload_register(function ($class_name) {
	if ( strpos($class_name, 'Exception') === false ) {
		require_once "src/" . $class_name . '.php';
	}
	else {
		require_once "src/Exceptions.php";
	}

});