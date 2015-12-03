<?php
namespace gossi\swagger;

use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Definitions implements Arrayable {
	
	/** @var Map */
	private $properties;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents) {
		$props = CollectionUtils::toMap($contents);

		foreach ($props as $name => $prop) {
			$this->properties->set($name, new Schema($prop));
		}
	}
	
	public function toArray() {
		
	}
	
	/**
	 * Returns whether the given field exists
	 * 
	 * @param string $name
	 * @return boolean
	 */
	public function has($name) {
		return $this->properties->has($name);
	}
	
	/**
	 * Returns the schema for the given field
	 * 
	 * @param string $name
	 * @return Schema
	 */
	public function get($name) {
		return $this->properties->get($name);
	}
	
	/**
	 * Sets the field
	 * 
	 * @param string name
	 * @param Schema $schame
	 */
	public function set($name, Schema $schema) {
		$this->properties->set($name, $schema);
	}
	
	/**
	 * Removes the given field
	 * 
	 * @param string $name
	 */
	public function remove($name) {
		$this->properties->remove($name);
	}
}
