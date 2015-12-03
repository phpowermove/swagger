<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait RequiredPart {
	
	/** @var boolean */
	private $required = false;
	
	private function parseRequired(Map $data) {
		$this->required = $data->has('required') && $data->get('required');
	}
	
	/**
	 *
	 * @return boolean
	 */
	public function getRequired() {
		return $this->required;
	}
	
	/**
	 *
	 * @param boolean $required
	 * @return $this
	 */
	public function setRequired($required) {
		$this->required = $required;
		return $this;
	}

}