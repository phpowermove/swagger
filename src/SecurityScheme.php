<?php
namespace gossi\swagger;

use phootwork\lang\Arrayable;

class SecurityScheme extends AbstractModel implements Arrayable {

	/** @var string */
	private $name;

	/** @var string */
	private $type;

	/** @var string */
	private $description;

	/**
	 * @param string $name
	 * @param array $contents
	 */
	public function __construct($name, $contents = []) {
		$this->name = $name;
		$this->parse($contents);
	}

	/**
	 * @param array $contents
	 */
	private function parse($contents = []) {
		$this->type = $contents->get('type');
		$this->description = $contents->get('description');
	}

	/**
	 * @return array
	 */
	public function toArray() {
		return $this->export('type', 'description');
	}
}
