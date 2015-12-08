<?php

namespace gossi\swagger\parts;

use phootwork\collection\Map;
use gossi\swagger\Items;

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