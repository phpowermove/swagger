<?php
namespace gossi\swagger\parts;

use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;
use phootwork\collection\Set;

trait ConsumesPart {

	private $consumes;

	private function parseConsumes(Map $data) {
		$this->consumes = $data->get('consumes', new Set());
	}

	private function mergeConsumes(static $model, $overwrite = false) {
		MergeHelper::mergeFields($this->consumes, $model->consumes, $overwrite);
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
