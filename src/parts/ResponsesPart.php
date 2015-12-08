<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use gossi\swagger\Response;

trait ResponsesPart {
	
	private $responses;
	
	private function parseResponses(Map $data) {
		$this->responses = $data->get('responses', new Map());
		foreach ($this->responses as $r => $response) {
			$this->responses->set($r, new Response($r, $response));
		}
	}
	
	/**
	 * Return responses
	 *
	 * @return Map
	 */
	public function getResponses() {
		return $this->responses;
	}

}