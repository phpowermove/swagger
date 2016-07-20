<?php
namespace gossi\swagger\parts;

use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;
use phootwork\collection\Set;

trait ProducesPart {

	private $produces;

	private function parseProduces(Map $data) {
		$this->produces = $data->get('produces', new Set());
	}

	private function mergeProduces(static $model, $overwrite = false) {
		MergeHelper::mergeFields($this->produces, $model->produces, $overwrite);
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
