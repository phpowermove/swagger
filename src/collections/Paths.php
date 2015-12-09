<?php
namespace gossi\swagger\collections;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\Path;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;
use phootwork\lang\Text;
use phootwork\collection\CollectionUtils;

class Paths implements Arrayable {
	
	use ExtensionPart;
	
	/** @var Map */
	private $paths;

	public function __construct($contents = null) {
		$this->parse($contents === null ? new Map() : $contents);
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
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		$paths = clone $this->paths;
		$paths->setAll($this->getExtensions());
		return $paths->toArray();
	}
	
	public function size() {
		return $this->paths->size();
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
	 * @return $this
	 */
	public function add(Path $path) {
		$this->paths->set($path->getPath(), $path);
		return $this;
	}
	
	/**
	 * Removes the given path
	 * 
	 * @param string $path
	 */
	public function remove($path) {
		$this->paths->remove($path);
		return $this;
	}
}
