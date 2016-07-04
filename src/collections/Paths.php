<?php
namespace gossi\swagger\collections;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\Path;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;
use phootwork\lang\Text;
use gossi\swagger\AbstractModel;

class Paths extends AbstractModel implements Arrayable, \Iterator {

	use ExtensionPart;

	/** @var Map */
	private $paths;

	public function __construct($contents = []) {
		$this->parse($contents === null ? [] : $contents);
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
// 		$paths = clone $this->paths;
// 		$paths->setAll($this->getExtensions());
// 		return $paths->toArray();
		return CollectionUtils::toArrayRecursive($this->paths);
	}

	public function size() {
		return $this->paths->size();
	}

	/**
	 * Returns whether a path with the given name exists
	 *
	 * @param string $path
	 * @return bool
	 */
	public function has($path) {
		return $this->paths->has($path);
	}

	/**
	 * Returns whether the given path exists
	 *
	 * @param Path $path
	 * @return bool
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
		if (!$this->paths->has($path)) {
			$this->paths->set($path, new Path($path));
		}
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
	 * Adds all operations from another paths collection. Will overwrite existing operations.
	 *
	 * @param Paths $paths
	 */
	public function addAll(Paths $paths) {
		foreach ($paths as $p) {
			$path = $this->get($p->getPath());
			foreach ($p->getMethods() as $method) {
				$path->setOperation($method, $p->getOperation($method));
			}
		}
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

	public function current() {
		return $this->paths->current();
	}

	public function key() {
		return $this->paths->key();
	}

	public function next() {
		return $this->paths->next();
	}

	public function rewind() {
		return $this->paths->rewind();
	}

	public function valid() {
		return $this->paths->valid();
	}
}
