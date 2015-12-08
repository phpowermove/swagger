<?php
namespace gossi\swagger\collections;

use gossi\swagger\parts\RefPart;
use phootwork\collection\ArrayList;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;
use gossi\swagger\Parameter;

class Parameters implements Arrayable {
	
	use RefPart;
	
	/** @var ArrayList */
	private $parameters;
	
	public function __construct($contents = null) {
		$this->parse($contents === null ? new ArrayList() : $contents);
	}
	
	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);
		
		$this->parameters = new ArrayList();
		$this->parseRef($data);
		
		if (!$this->hasRef()) {
			foreach ($data as $param) {
				$this->parameters->add(new Parameter($param));
			}
		}
	}
	
	public function toArray() {
		if ($this->hasRef()) {
			return ['$ref' => $this->getRef()];
		}
		
		return $this->parameters->toArray();
	}
	
	public function size() {
		return $this->parameters->size();
	}

	/**
	 * Find parameter by name
	 * 
	 * @param string $name
	 * @return Parameter
	 */
	public function findByName($name) {
		return $this->search($name, function(Parameter $param, $name) {
			return $param->getName() == $name;
		});
	}
	
	/**
	 * Adds a parameter
	 * 
	 * @param Parameter $param
	 */
	public function add(Parameter $param) {
		$this->parameters->add($param);
	}
	
	/**
	 * Removes a parameter
	 * 
	 * @param Parameter $param
	 */
	public function remove(Parameter $param) {
		$this->parameters->remove($param);
	}
	
	/**
	 * Returns whether a given parameter exists
	 * 
	 * @param Parameter $param
	 * @return boolean
	 */
	public function contains(Parameter $param) {
		return $this->parameters->contains($param);
	}
}
