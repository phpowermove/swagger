<?php
namespace gossi\swagger\collections;

use gossi\swagger\Schema;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;
use phootwork\collection\Map;

class Definitions implements Arrayable {
	
	/** @var Map */
	private $definitions;

	public function __construct($contents = null) {
		$this->parse($contents === null ? new Map() : $contents);
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
	 * @return boolean
	 */
	public function has($name) {
		return $this->definitions->has($name);
	}
	
	/**
	 * Returns whether the given schema exists
	 * 
	 * @param Schema $schema
	 * @return boolean
	 */
	public function contains(Schema $schema) {
		return $this->definitions->contains($schema);
	}
}
