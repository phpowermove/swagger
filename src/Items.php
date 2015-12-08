<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ItemsPart;
use gossi\swagger\parts\TypePart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;
use gossi\swagger\parts\RefPart;

class Items extends AbstractModel implements Arrayable {
	
	use RefPart;
	use TypePart;
	use ItemsPart;
	use ExtensionPart;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		// parts
		$this->parseRef($data);
		$this->parseType($data);
		$this->parseItems($data);
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		return $this->export($this->getTypeExportFields(), 'items');
	}

}