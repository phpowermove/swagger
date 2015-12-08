<?php
namespace gossi\swagger\collections;

use gossi\swagger\Header;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Headers implements Arrayable {
	
	/** @var Map */
	private $headers;
	
	public function __construct($contents = null) {
		$this->parse($contents === null ? new Map() : $contents);
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
	public function set(Header $header) {
		$this->headers->set($header->getCode(), $header);
	}
	
	/**
	 * Removes the given header
	 * 
	 * @param string $header
	 */
	public function remove($header) {
		$this->headers->remove($header);
	}
	
}
