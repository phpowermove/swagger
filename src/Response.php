<?php
namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use phootwork\collection\CollectionUtils;
use gossi\swagger\parts\SchemaPart;
use phootwork\collection\Map;
use gossi\swagger\parts\RefPart;
use gossi\swagger\parts\ExtensionPart;
use phootwork\lang\Arrayable;
use gossi\swagger\collections\Headers;

class Response extends AbstractModel implements Arrayable {
	
	use RefPart;
	use DescriptionPart;
	use SchemaPart;
	use ExtensionPart;
	
	/** @var string */
	private $code;
	
	/** @var Map */
	private $examples;
	
	/** @var Headers */
	private $headers;
	
	public function __construct($code, $contents = []) {
		$this->code = $code;
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);
		
		$this->examples = $data->get('examples', new Map());
		$this->headers = new Headers($data->get('headers'));
		
		// parts
		$this->parseRef($data);
		$this->parseDescription($data);
		$this->parseSchema($data);
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		return $this->export('description', 'schema', 'headers', 'examples');
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
	
	/**
	 * Returns headers for this response
	 * 
	 * @return Headers
	 */
	public function getHeaders() {
		return $this->headers;
	}

}