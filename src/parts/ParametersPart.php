<?php
namespace gossi\swagger\parameters;

use gossi\swagger\Parameters;
use phootwork\collection\Map;

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