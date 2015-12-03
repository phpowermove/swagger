<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use phootwork\collection\ArrayList;

trait ConsumesPart {
	
	private $consumes;
	
	private function parseConsumes(Map $data) {
		$this->consumes = $data->get('consumes', new ArrayList());
	}
	
	/**
	 * Return consumes
	 *
	 * @return ArrayList
	 */
	public function getConsumes() {
		return $this->consumes;
	}

}