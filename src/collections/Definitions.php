<?php
namespace gossi\swagger\collections;

use gossi\swagger\Schema;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Definitions implements Arrayable, \Iterator {

	/** @var Map */
	private $definitions;

	public function __construct($contents = []) {
		$this->parse($contents === null ? [] : $contents);
	}

	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);

		$this->definitions = new Map();
		foreach ($data as $name => $prop) {
			$this->definitions->set($name, new Schema($prop));
		}
	}

	public function toArray() {
		return $this->definitions->toArray();
	}

	public function size() {
		return $this->definitions->size();
	}

	/**
	 * Returns the schema for the given field
	 * 
	 * @param string $name
	 * @return Schema
	 */
	public function get($name) {
		if (!$this->definitions->has($name)) {
			$this->definitions->set($name, new Schema());
		}
		return $this->definitions->get($name);
	}

	/**
	 * Sets the field
	 * 
	 * @param string name
	 * @param Schema $schame
	 */
	public function set($name, Schema $schema) {
		$this->definitions->set($name, $schema);
	}

	/**
	 * Removes the given field
	 * 
	 * @param string $name
	 */
	public function remove($name) {
		$this->definitions->remove($name);
	}

	/**
	 * Returns definitions has a schema with the given name
	 * 
	 * @param string $name
	 * @return bool
	 */
	public function has($name) {
		return $this->definitions->has($name);
	}

	/**
	 * Returns whether the given schema exists
	 * 
	 * @param Schema $schema
	 * @return bool
	 */
	public function contains(Schema $schema) {
		return $this->definitions->contains($schema);
	}

	public function current() {
		return $this->definitions->current();
	}

	public function key() {
		return $this->definitions->key();
	}

	public function next() {
		return $this->definitions->next();
	}

	public function rewind() {
		return $this->definitions->rewind();
	}

	public function valid() {
		return $this->definitions->valid();
	}
}
