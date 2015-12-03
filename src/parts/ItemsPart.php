<?php

namespace gossi\swagger\parts;

use phootwork\collection\Map;
use gossi\swagger\Items;

trait ItemsPart {
	
	private function parseItems(Map $data) {
		$this->items = new Items($data);
	}
}