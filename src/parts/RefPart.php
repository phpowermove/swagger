<?php
namespace gossi\swagger\parts;

use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;

trait RefPart {

	/** @var string */
	private $ref;

	private function parseRef(Map $data) {
		$this->ref = $data->get('$ref');
	}

	private function mergeRef(static $model, $overwrite = false) {
		MergeHelper::mergeFields($this->ref, $model->ref, $overwrite);
	}

	/**
	 *
	 * @return the string
	 */
	public function getRef() {
		return $this->ref;
	}

	/**
	 *
	 * @param
	 *        	$ref
	 */
	public function setRef($ref) {
		$this->ref = $ref;
		return $this;
	}

	public function hasRef() {
		return null !== $this->ref;
	}

}
