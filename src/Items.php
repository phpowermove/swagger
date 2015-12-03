<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ItemsPart;
use gossi\swagger\parts\TypePart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Items implements Arrayable {
	
	use TypePart;
	use ItemsPart;
	use ExtensionPart;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		// parts
		$this->parseType($data);
		$this->parseItems($data);
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		
	}

}