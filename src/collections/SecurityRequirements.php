<?php
namespace gossi\swagger\collections;

use gossi\swagger\AbstractModel;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\collection\Set;
use phootwork\lang\Arrayable;

class SecurityRequirements extends AbstractModel implements Arrayable, \Iterator {

	/** @var Map */
	private $securities;

	public function __construct($contents = []) {
		$this->parse($contents === null ? [] : $contents);
	}

	private function parse($contents) {
		$data = CollectionUtils::toList($contents);

		// schemes
		$this->securities = new Map();
		foreach ($data as $security) {
			foreach ($security as $id => $scopes) {
				$this->securities->set($id, new Set($scopes));
			}
		}
	}

	public function toArray() {
		$out = [];
		foreach ($this->securities as $id => $scopes) {
			$out[$id] = $scopes->toArray();
		}
		if (count($out)) {
			$out = [$out];
		}
		return $out;
	}

	public function size() {
		return $this->securities->size();
	}

	/**
	 * Returns whether a security with the given id exists
	 *
	 * @param string $id
	 * @return bool
	 */
	public function has($id) {
		return $this->securities->has($id);
	}

	/**
	 * Returns the scopes for the given id
	 *
	 * @param string $id
	 * @return Set
	 */
	public function get($id) {
		if (!$this->securities->has($id)) {
			$this->securities->set($id, new Set());
		}
		return $this->securities->get($id);
	}

	/**
	 * Sets the scheme
	 *
	 * @param string $id
	 * @param Set $scopes
	 * @return $this
	 */
	public function add($id, Set $scopes) {
		$this->securities->set($id, $scopes);
		return $this;
	}

	/**
	 * Removes the given security
	 *
	 * @param string $id
	 */
	public function remove($id) {
		$this->securities->remove($id);
		return $this;
	}

	public function current() {
		return $this->securities->current();
	}

	public function key() {
		return $this->securities->key();
	}

	public function next() {
		return $this->securities->next();
	}

	public function rewind() {
		return $this->securities->rewind();
	}

	public function valid() {
		return $this->securities->valid();
	}
}
