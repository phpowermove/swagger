<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;
use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\UrlPart;

class ExternalDocs extends AbstractModel implements Arrayable {

	use DescriptionPart;
	use UrlPart;
	use ExtensionPart;

	public function __construct($contents = []) {
		$this->parse($contents);
	}

	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		// parts
		$this->parseDescription($data);
		$this->parseUrl($data);
		$this->parseExtensions($data);
	}

	public function toArray() {
		return $this->export('description', 'url');
	}

}