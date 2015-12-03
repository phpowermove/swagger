<?php
namespace gossi\swagger\parts;

use gossi\swagger\ExternalDocs;
use phootwork\collection\Map;

trait ExternalDocsPart {
	
	private $externalDocs;
	
	private function parseExternalDocs(Map $data) {
		$this->externalDocs = new ExternalDocs($data->get('externalDocs'));
	}
	
	/**
	 *
	 * @return ExternalDocs
	 */
	public function getExternalDocs() {
		return $this->externalDocs;
	}
	
	/**
	 *
	 * @param ExternalDocs $externalDocs   
	 * @return $this     	
	 */
	public function setExternalDocs(ExternalDocs $externalDocs) {
		$this->externalDocs = $externalDocs;
		return $this;
	}
}