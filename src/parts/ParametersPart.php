<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use gossi\swagger\collections\Parameters;

trait ParametersPart {

	/** @var Parameters */
	private $parameters;
	
	private function parseParameters(Map $data) {
		$this->parameters = new Parameters($data);
	}
	
	/**
	 * Return parameters
	 *
	 * @return Parameters
	 */
	public function getParameters() {
		return $this->parameters;
	}

}