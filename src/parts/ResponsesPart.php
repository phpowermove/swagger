<?php
namespace gossi\swagger\parts;

use gossi\swagger\collections\Responses;
use phootwork\collection\Map;

trait ResponsesPart {

	/** @var Responses */
	private $responses;

	private function parseResponses(Map $data) {
		$this->responses = new Responses($data->get('responses', new Map()));
	}

	/**
	 * Return responses
	 *
	 * @return Responses
	 */
	public function getResponses() {
		return $this->responses;
	}

}
