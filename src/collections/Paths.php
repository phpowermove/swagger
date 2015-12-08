<?php
namespace gossi\swagger\collections;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\Path;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;
use phootwork\lang\Text;

class Paths implements Arrayable {
	
	use ExtensionPart;
	
	/** @var Map */
	private $paths;

	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);

		// paths
		$this->paths = new Map();
		foreach ($data as $p => $path) {
			if (!Text::create($p)->startsWith('x-')) {
				$this->paths->set($p, new Path($p, $path));
			}
		}

		// extensions
// 		$this->parseExtensions($data);
	}
	
	public function toArray() {
		
	}
	
	/**
	 * Returns whether a path with the given name exists
	 * 
	 * @param string $path
	 * @return boolean
	 */
	public function has($path) {
		return $this->paths->has($path);
	}
	
	/**
	 * Returns whether the given path exists
	 * 
	 * @param Path $path
	 * @return boolean
	 */
	public function contains(Path $path) {
		return $this->paths->contains($path);
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
