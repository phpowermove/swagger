<?php
namespace gossi\swagger\parts;

use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;

trait RequiredPart {

	/** @var bool */
	private $required;

	private function parseRequired(Map $data) {
		$this->required = $data->get('required');
	}

	private function mergeRequired(static $model, $overwrite = false) {
		MergeHelper::mergeFields($this->required, $model->required, $overwrite);
	}

	/**
	 *
	 * @return bool
	 */
	public function getRequired() {
		return null !== $this->required ? $this->required : false;
	}

	/**
	 *
	 * @param bool|null $required
	 * @return $this
	 */
	public function setRequired($required) {
		$this->required = $required;
		return $this;
	}

}
