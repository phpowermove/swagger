<?php
namespace gossi\swagger;

class SecurityScheme {

	/** @var string */
	private $name;

	public function __construct($name, $contents = []) {
		$this->name = $name;
		$this->parse($contents);
	}

	private function parse($contents = []) {

	}
}