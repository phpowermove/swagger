<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Text;
use phootwork\lang\Arrayable;

class Paths implements Arrayable {
	
	use ExtensionPart;
	
	/** @var Map */
	private $paths;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents) {
		$paths = CollectionUtils::toMap($contents);

		// paths
		foreach ($paths as $p => $path) {
			if (!Text::create($p)->startsWith('x-')) {
				$this->paths->set($p, new Path($p, $path));
			}
		}

		// extensions
		$this->parseExtensions($paths);
	}
	
	public function toArray() {
		
	}
	
	/**
	 * Returns whether the given path exists
	 * 
	 * @param string $path
	 * @return boolean
	 */
	public function has($path) {
		return $this->paths->has($path);
	}
	
	/**
	 * Returns the path info for the given path
	 * 
	 * @param string $path
	 * @return Path
	 */
	public function get($path) {
		return $this->paths->get($path);
	}
	
	/**
	 * Sets the path
	 * 
	 * @param Path $path
	 */
	public function set(Path $path) {
		$this->paths->set($path->getPath(), $path);
	}
	
	/**
	 * Removes the given path
	 * 
	 * @param string $path
	 */
	public function remove($path) {
		$this->paths->remove($path);
	}
}
