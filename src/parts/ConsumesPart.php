<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use phootwork\collection\Set;

trait ConsumesPart {

	private $consumes;

	private function parseConsumes(Map $data) {
		$this->consumes = $data->get('consumes', new Set());
	}

	/**
	 * Return consumes
	 *
	 * @return Set
	 */
	public function getConsumes() {
		return $this->consumes;
	}

}