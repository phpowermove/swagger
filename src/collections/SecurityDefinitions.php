<?php
namespace gossi\swagger\collections;

use gossi\swagger\AbstractModel;
use gossi\swagger\SecurityScheme;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class SecurityDefinitions extends AbstractModel implements Arrayable, \Iterator {

	/** @var Map */
	private $schemes;

	public function __construct($contents = []) {
		$this->parse($contents === null ? [] : $contents);
	}

	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);

		// schemes
		$this->schemes = new Map();
		foreach ($data as $id => $scheme) {
			$this->schemes->set($id, new SecurityScheme($id, $scheme));
		}
	}

	public function toArray() {
		return CollectionUtils::toArrayRecursive($this->schemes);
	}

	public function size() {
		return $this->schemes->size();
	}

	/**
	 * Returns whether a scheme with the given id exists
	 *
	 * @param string $id
	 * @return bool
	 */
	public function has($id) {
		return $this->schemes->has($id);
	}

	/**
	 * Returns whether the given scheme exists
	 *
	 * @param SecurityScheme $scheme
	 * @return bool
	 */
	public function contains(SecurityScheme $scheme) {
		return $this->schemes->contains($scheme);
	}

	/**
	 * Returns the scheme info for the given id
	 *
	 * @param string $id
	 * @return SecurityScheme
	 */
	public function get($id) {
		if (!$this->schemes->has($id)) {
			$this->schemes->set($id, new SecurityScheme($id));
		}
		return $this->schemes->get($id);
	}

	/**
	 * Sets the scheme
	 *
	 * @param SecurityScheme $scheme
	 * @return $this
	 */
	public function add(SecurityScheme $scheme) {
		$this->schemes->set($scheme->getId(), $scheme);
		return $this;
	}

	/**
	 * Adds all schemes from another definitions collection. Will overwrite existing operations.
	 *
	 * @param SecurityDefinitions $schemes
	 */
	public function addAll(SecurityDefinitions $definitions) {
		foreach ($definitions as $scheme) {
			$this->add($scheme);
		}
	}

	/**
	 * Removes the given scheme
	 *
	 * @param string $scheme
	 */
	public function remove($scheme) {
		$this->schemes->remove($scheme);
		return $this;
	}

	public function current() {
		return $this->schemes->current();
	}

	public function key() {
		return $this->schemes->key();
	}

	public function next() {
		return $this->schemes->next();
	}

	public function rewind() {
		return $this->schemes->rewind();
	}

	public function valid() {
		return $this->schemes->valid();
	}
}
