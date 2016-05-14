<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait RefPart {

	/** @var string */
	private $ref;

	/** @var boolean */
	private $hasRef = false;

	private function parseRef(Map $data) {
		$this->ref = $data->get('$ref');
		$this->hasRef = $data->has('$ref');
	}

	/**
	 *
	 * @return the string
	 */
	public function getRef() {
		return $this->ref;
	}

	/**
	 *
	 * @param
	 *        	$ref
	 */
	public function setRef($ref) {
		$this->ref = $ref;
		$this->hasRef = $ref !== null;
		return $this;
	}

	public function hasRef() {
		return $this->hasRef;
	}

}