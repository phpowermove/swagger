<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\UrlPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class License extends AbstractModel implements Arrayable {

	use UrlPart;
	use ExtensionPart;

	/** @var string */
	private $name;

	public function __construct($contents = []) {
		$this->parse($contents);
	}

	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		$this->name = $data->get('name');

		// extensions
		$this->parseUrl($data);
		$this->parseExtensions($data);
	}

	public function toArray() {
		return $this->export('name', 'url');
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
	 * @return $this
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

}
