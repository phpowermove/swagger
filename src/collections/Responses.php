<?php
namespace gossi\swagger\collections;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\Response;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;
use phootwork\lang\Text;

class Responses implements Arrayable, \Iterator {

	use ExtensionPart;

	/** @var Map */
	private $responses;

	public function __construct($contents = []) {
		$this->parse($contents === null ? [] : $contents);
	}

	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);

		// responses
		$this->responses = new Map();
		foreach ($data as $r => $response) {
			if (!Text::create($r)->startsWith('x-')) {
				$this->responses->set($r, new Response($r, $response));
			}
		}

		// extensions
		$this->parseExtensions($data);
	}

	public function toArray() {
		$responses = clone $this->responses;
		$responses->setAll($this->getExtensions());
		return $responses->toArray();
	}

	public function size() {
		return $this->responses->size();
	}

	/**
	 * Returns whether the given response exists
	 * 
	 * @param string $code
	 * @return bool
	 */
	public function has($code) {
		return $this->responses->has($code);
	}

	/**
	 * Returns whether the given response exists
	 * 
	 * @param Response $response
	 * @return bool
	 */
	public function contains(Response $response) {
		return $this->responses->contains($response);
	}

	/**
	 * Returns the reponse info for the given code
	 * 
	 * @param string $code
	 * @return Response
	 */
	public function get($code) {
		if (!$this->responses->has($code)) {
			$this->responses->set($code, new Response($code));
		}

		return $this->responses->get($code);
	}

	/**
	 * Sets the response
	 * 
	 * @param Response $code
	 */
	public function add(Response $response) {
		$this->responses->set($response->getCode(), $response);
	}

	/**
	 * Removes the given repsonse
	 * 
	 * @param string $code
	 */
	public function remove($code) {
		$this->responses->remove($code);
	}

	public function current() {
		return $this->responses->current();
	}

	public function key() {
		return $this->responses->key();
	}

	public function next() {
		return $this->responses->next();
	}

	public function rewind() {
		return $this->responses->rewind();
	}

	public function valid() {
		return $this->responses->valid();
	}
}
