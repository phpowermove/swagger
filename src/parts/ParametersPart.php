<?php
namespace gossi\swagger\parts;

use gossi\swagger\collections\Parameters;
use phootwork\collection\Map;

trait ParametersPart {

	/** @var Parameters */
	private $parameters;

	private function parseParameters(Map $data) {
		$this->parameters = new Parameters($data->get('parameters', new Map()));
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
