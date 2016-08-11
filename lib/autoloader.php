<?php

spl_autoload_register(function ($class_name) {
	if ( strpos($class_name, 'Exception') === false ) {
		include "lib/" . $class_name . '.php';
	}
	else {
		include "lib/Exceptions.php";
	}

});