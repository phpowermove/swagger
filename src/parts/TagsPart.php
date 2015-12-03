<?php
namespace gossi\swagger\tags;

use phootwork\collection\Map;
use phootwork\collection\ArrayList;
use gossi\swagger\Tag;

trait TagsPart {
	
	private $tags;
	
	private function parseTags(Map $data) {
		$this->tags = new ArrayList();
		foreach ($data->get('tags', []) as $t) {
			$this->tags->add(new Tag($t));
		}
	}
	
	/**
	 * Return tags
	 *
	 * @return ArrayList
	 */
	public function getTags() {
		return $this->tags;
	}

}