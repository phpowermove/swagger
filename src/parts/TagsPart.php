<?php
namespace gossi\swagger\parts;

use gossi\swagger\Tag;
use gossi\swagger\util\MergeHelper;
use phootwork\collection\ArrayList;
use phootwork\collection\Map;

trait TagsPart {

	private $tags;

	private function parseTags(Map $data) {
		$this->tags = new ArrayList();
		foreach ($data->get('tags', []) as $t) {
			$this->tags->add(new Tag($t));
		}
	}

	private function mergeTags(static $model, $overwrite = false) {
		$newTags = [];
		foreach ($model->tags as $tag) {
			$find = $this->tags->find(function(Tag $element) use ($tag) {
				return $tag->getName() === $element->getName();
			});

			if (null !== $find) {
				$find->merge($tag, $overwrite);
			} else {
				$newTags[] = new Tag($tag->toArray());
			}
		}

		$this->tags->addAll($newTags);
	}

	/**
	 * Return tags
	 *
	 * @return ArrayList
	 */
	public function getTags() {
		return $this->tags;
	}

	protected function exportTags() {
		$out = [];
		foreach ($this->tags as $tag) {
			if ($tag->isObject()) {
				$out[] = $tag->toArray();
			} else {
				$out[] = $tag->getName();
			}
		}

		return $out;
	}

}
