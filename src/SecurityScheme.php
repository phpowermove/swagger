<?php
namespace gossi\swagger;

use phootwork\lang\Arrayable;

class SecurityScheme extends AbstractModel implements Arrayable {

	/** @var string */
	private $name;

	/** @var string */
	private $type;

	public function __construct($name, $contents = []) {
		$this->name = $name;
		$this->parse($contents);
	}

	private function parse($contents = []) {
		$this->type = $contents->get('type');
	}

	public function toArray() {
		return $this->export('type');
	}
}
