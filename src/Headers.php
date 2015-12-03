<?php
namespace gossi\swagger;

use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Headers implements Arrayable {
	
	/** @var Map */
	private $headers;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents) {
		$headers = CollectionUtils::toMap($contents);

		// headers
		foreach ($headers as $h => $header) {
			$this->headers->set($h, new Header($header));
		}
	}
	
	public function toArray() {
		
	}
	
	/**
	 * Returns whether the given header exists
	 * 
	 * @param string $header
	 * @return boolean
	 */
	public function has($header) {
		return $this->headers->has($header);
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
	public function set(Response $header) {
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
