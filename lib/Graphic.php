<?php

/**
 * Created by PhpStorm.
 * User: fabriziogargiulo
 * Date: 09/08/16
 * Time: 20:21
 */
abstract class Graphic {
	/*
	protected $origin = array('x' => 0, 'y' => 0);
	protected $width = 0;
	protected $height = 0;

	// This can be applied by decorator
	protected $border_size = "0";
	protected $border_color = "#ffffff";
	protected $filler_color = "#ffffff";
	*/


	protected $settings = array();

	public function __construct($settings) {
		$this->settings = $settings;
	}
}