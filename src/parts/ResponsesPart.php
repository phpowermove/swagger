<?php
namespace gossi\swagger\parts;

use gossi\swagger\collections\Responses;
use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;

trait ResponsesPart {

	/** @var Responses */
	private $responses;

	private function parseResponses(Map $data) {
		$this->responses = new Responses($data->get('responses', new Map()));
	}

	private function mergeResponses(static $model, $overwrite = false) {
		$this->responses->merge($model->responses, $overwrite);
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
