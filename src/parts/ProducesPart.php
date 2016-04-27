<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use phootwork\collection\Set;

trait ProducesPart {
	
	private $produces;
	
	private function parseProduces(Map $data) {
		$this->produces = $data->get('produces', new Set());
	}
	
	/**
	 * Return produces
	 *
	 * @return Set
	 */
	public function getProduces() {
		return $this->produces;
	}

}