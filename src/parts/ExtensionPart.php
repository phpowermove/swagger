<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use phootwork\lang\Text;

trait ExtensionPart {

	private $extensions;

	private function parseExtensions(Map $data) {
		$this->extensions = new Map();

		foreach ($data as $k => $v) {
			$key = new Text($k);
			if ($key->startsWith('x-')) {
				$this->extensions->set($key->substring(2), $v);
			}
		}
	}

	/**
	 * Returns extensions
	 * 
	 * @return Map
	 */
	public function getExtensions() {
		return $this->extensions;
	}
}
