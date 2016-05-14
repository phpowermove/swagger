<?php
namespace gossi\swagger\collections;

use gossi\swagger\Header;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Headers implements Arrayable, \Iterator {

	/** @var Map */
	private $headers;

	public function __construct($contents = []) {
		$this->parse($contents === null ? [] : $contents);
	}

	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);

		// headers
		$this->headers = new Map();
		foreach ($data as $h => $props) {
			$this->headers->set($h, new Header($h, $props));
		}
	}

	public function toArray() {
		return $this->headers->toArray();
	}

	public function size() {
		return $this->headers->size();
	}

	/**
	 * Returns whether a header with the given name exists
	 * 
	 * @param string $header
	 * @return boolean
	 */
	public function has($header) {
		return $this->headers->has($header);
	}

	/**
	 * Returns whether the given header exists
	 *
	 * @param Header $header
	 * @return boolean
	 */
	public function contains(Header $header) {
		return $this->headers->contains($header);
	}

	/**
	 * Returns the header info for the given code
	 * 
	 * @param string $header
	 * @return Header
	 */
	public function get($header) {
		return $this->headers->get($header);
	}

	/**
	 * Sets the header
	 * 
	 * @param Header $header
	 */
	public function add(Header $header) {
		$this->headers->set($header->getHeader(), $header);
	}

	/**
	 * Removes the given header
	 * 
	 * @param string $header
	 */
	public function remove($header) {
		$this->headers->remove($header);
	}

	public function current() {
		return $this->headers->current();
	}

	public function key() {
		return $this->headers->key();
	}

	public function next() {
		return $this->headers->next();
	}

	public function rewind() {
		return $this->headers->rewind();
	}

	public function valid() {
		return $this->headers->valid();
	}
}
