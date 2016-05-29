<?php
namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Tag extends AbstractModel implements Arrayable {

	use DescriptionPart;
	use ExternalDocsPart;
	use ExtensionPart;

	/** @var string */
	private $name;

	private $isObject = true;

	public function __construct($contents = []) {
		$this->parse($contents);
	}

	private function parse($contents = []) {
		if (is_string($contents)) {
			$this->isObject = false;
			$this->name = $contents;
		} else {
			$data = CollectionUtils::toMap($contents);

			$this->isObject = true;
			$this->name = $data->get('name');

			// parts
			$this->parseDescription($data);
			$this->parseExternalDocs($data);
			$this->parseExtensions($data);
		}
	}

	public function toArray() {
		return $this->export('name', 'description', 'externalDocs');
	}

	public function isObject() {
		return $this->isObject;
	}

	public function setObject($object) {
		$this->isObject = $object;
	}

	/**
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

}
