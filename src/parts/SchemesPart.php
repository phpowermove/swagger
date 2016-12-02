<?php
namespace gossi\swagger\parts;

use gossi\swagger\util\MergeHelper;
use phootwork\collection\ArrayList;
use phootwork\collection\Map;

trait SchemesPart {

	private $schemes;

	private function parseSchemes(Map $data) {
		$this->schemes = $data->get('schemes', new ArrayList());
	}

	private function mergeSchemes(static $model, $overwrite = false) {
		$this->schemes->addAll($model->schemes);
	}

	/**
	 * Return schemes
	 *
	 * @return ArrayList
	 */
	public function getSchemes() {
		return $this->schemes;
	}

}
