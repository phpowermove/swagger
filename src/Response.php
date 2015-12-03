<?php
namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use phootwork\collection\CollectionUtils;
use gossi\swagger\parts\SchemaPart;
use phootwork\collection\Map;
use gossi\swagger\parts\RefPart;
use gossi\swagger\parts\ExtensionPart;

class Response {
	
	use RefPart;
	use DescriptionPart;
	use SchemaPart;
	use ExtensionPart;
	
	/** @var string */
	private $code;
	
	/** @var Map */
	private $examples;
	
	public function __construct($code, $contents = []) {
		$this->code = $code;
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);
		
		$this->examples = $data->get('examples', new Map());
		
		// parts
		$this->parseRef($data);
		$this->parseDescription($data);
		$this->parseSchema($data);
		$this->parseExtensions($data);
	}

	/**
	 * Returns the responses code
	 * 
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * 
	 * @return Map
	 */
	public function getExamples() {
		return $this->examples;
	}

}