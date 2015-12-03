<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use phootwork\collection\ArrayList;

trait ProducesPart {
	
	private $produces;
	
	private function parseProduces(Map $data) {
		$this->produces = $data->get('produces', new ArrayList());
	}
	
	/**
	 * Return produces
	 *
	 * @return ArrayList
	 */
	public function getProduces() {
		return $this->produces;
	}

}