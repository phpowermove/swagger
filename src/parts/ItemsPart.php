<?php

namespace gossi\swagger\parts;

use gossi\swagger\Items;
use phootwork\collection\Map;

trait ItemsPart {

	/** @var */
	private $items;

	private function parseItems(Map $data) {
		if ($data->has('items')) {
			$this->items = new Items($data->get('items'));
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
