<?php

namespace gossi\swagger\parts;

use gossi\swagger\Items;
use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;

trait ItemsPart {

	/** @var */
	private $items;

	private function parseItems(Map $data) {
		if ($data->has('items')) {
			$this->items = new Items($data->get('items'));
		}
	}

	private function mergeItems(static $model, $overwrite = false) {
		if (null === $this->items) {
			$this->items = clone $model->items;
		} elseif (null !== $model->items) {
			$this->items->merge($model->items, $overwrite);
		}
	}

	/**
	 * Returns the items
	 *
	 * @return Items
	 */
	public function getItems() {
		if ($this->items === null) {
			$this->items = new Items();
		}

		return $this->items;
	}
}
