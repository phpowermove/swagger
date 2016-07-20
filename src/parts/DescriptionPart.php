<?php
namespace gossi\swagger\parts;

use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;

trait DescriptionPart {

	/** @var string|null */
	private $description;

	private function parseDescription(Map $data) {
		$this->description = $data->get('description');
	}

	private function mergeDescription(static $model, $overwrite = false) {
		MergeHelper::mergeFields($this->description, $model->description, $overwrite);
	}

	/**
	 *
	 * @return string|null
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 *
	 * @param string|null $description
	 * @return $this
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

}
