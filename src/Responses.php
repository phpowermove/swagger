<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Text;
use phootwork\lang\Arrayable;

class Responses implements Arrayable {
	
	use ExtensionPart;
	
	/** @var Map */
	private $responses;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents) {
		$responses = CollectionUtils::toMap($contents);

		// responses
		foreach ($responses as $r => $response) {
			if (!Text::create($r)->startsWith('x-')) {
				$this->responses->set($r, new Response($r, $response));
			}
		}
		
		// extensions
		$this->parseExtensions($responses);
	}
	
	public function toArray() {
		
	}
	
	/**
	 * Returns whether the given response exists
	 * 
	 * @param string $code
	 * @return boolean
	 */
	public function has($code) {
		return $this->responses->has($code);
	}
	
	/**
	 * Returns the reponse info for the given code
	 * 
	 * @param string $code
	 * @return Response
	 */
	public function get($code) {
		return $this->responses->get($code);
	}
	
	/**
	 * Sets the response
	 * 
	 * @param Response $code
	 */
	public function set(Response $code) {
		$this->responses->set($code->getCode(), $code);
	}
	
	/**
	 * Removes the given repsonse
	 * 
	 * @param string $code
	 */
	public function remove($code) {
		$this->responses->remove($code);
	}
}
