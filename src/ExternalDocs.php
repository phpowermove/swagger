<?php
namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\UrlPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

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

	/**
	 * {@inheritdoc}
	 */
	public function merge(static $model, $overwrite = false) {
		$this->mergeDescription($model, $overwrite);
		$this->mergeUrl($model, $overwrite);
		$this->mergeExtensions($model, $overwrite);
	}

	public function toArray() {
		return $this->export('description', 'url');
	}

}
