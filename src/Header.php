<?php
namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ItemsPart;
use gossi\swagger\parts\TypePart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Header extends AbstractModel implements Arrayable {

	use DescriptionPart;
	use TypePart;
	use ItemsPart;
	use ExtensionPart;

	/** @var string */
	private $header;

	public function __construct($header, $contents = []) {
		$this->header = $header;
		$this->parse($contents);
	}

	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		// parts
		$this->parseDescription($data);
		$this->parseType($data);
		$this->parseItems($data);
		$this->parseExtensions($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function merge(static $model, $overwrite = false) {
		if ($this->header !== $model->header) {
			throw new \InvalidArgumentException(sprintf('You can\'t merge two different headers (provided "%s" and "%s").', $this->header, $model->header));
		}

		$this->mergeDescription($model, $overwrite);
		$this->mergeType($model, $overwrite);
		$this->mergeItems($model, $overwrite);
		$this->mergeExtensions($model, $overwrite);
	}

	public function toArray() {
		return $this->export('description', $this->getTypeExportFields(), 'items');
	}

	/**
	 * Returns the header
	 *
	 * @return string
	 */
	public function getHeader() {
		return $this->header;
	}

}
