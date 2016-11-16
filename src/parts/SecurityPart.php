<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait SecurityPart {

	/** @var object */
	private $security;

	private function parseSecurity(Map $data) {
		$this->security = $data->get('security');
	}

	/**
	 * @return object
	 */
	public function getSecurity() {
		return $this->security;
	}

	/**
	 * @param object $security
	 * @return $this
	 */
	public function setSecurity($security) {
		$this->security = $security;
		return $this;
	}

}
