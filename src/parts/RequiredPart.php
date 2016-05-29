<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait RequiredPart {

	/** @var bool */
	private $required = false;

	private function parseRequired(Map $data) {
		$this->required = $data->has('required') && $data->get('required');
	}

	/**
	 *
	 * @return bool
	 */
	public function getRequired() {
		return $this->required;
	}

	/**
	 *
	 * @param bool $required
	 * @return $this
	 */
	public function setRequired($required) {
		$this->required = $required;
		return $this;
	}

}
