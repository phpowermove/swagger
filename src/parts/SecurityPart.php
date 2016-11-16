<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use gossi\swagger\collections\SecurityRequirements;

trait SecurityPart {

	/** @var SecurityRequirements */
	private $security;

	private function parseSecurity(Map $data) {
		$this->security = new SecurityRequirements($data->get('security'));
	}

	/**
	 * @return SecurityRequirements
	 */
	public function getSecurity() {
		return $this->security;
	}

}
