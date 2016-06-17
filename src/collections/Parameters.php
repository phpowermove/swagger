<?php
namespace gossi\swagger\collections;

use gossi\swagger\Parameter;
use gossi\swagger\parts\RefPart;
use phootwork\collection\ArrayList;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;
use gossi\swagger\AbstractModel;

class Parameters extends AbstractModel implements Arrayable, \Iterator {

	use RefPart;

	/** @var ArrayList */
	private $parameters;

	public function __construct($contents = []) {
		$this->parse($contents === null ? [] : $contents);
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

		return $this->exportRecursiveArray($this->parameters->toArray());
	}

	public function size() {
		return $this->parameters->size();
	}

	/**
	 * Searches whether a parameter with the given name exists
	 *
	 * @param string $name
	 * @return bool
	 */
	public function searchByName($name) {
		return $this->parameters->search($name, function (Parameter $param, $name) {
			return $param->getName() == $name;
		});
	}

	/**
	 * Returns parameter with the given name if it exists
	 *
	 * @param string $name
	 * @return Parameter|void
	 */
	public function findByName($name) {
		foreach ($this->parameters as $param) {
			if ($param->getName() == $name) {
				return $param;
			}
		}
	}

	/**
	 * Searches for the parameter with the given name. Creates a parameter with the given name
	 * if none exists
	 *
	 * @param string $name
	 * @return Parameter
	 */
	public function getByName($name) {
		$param = $this->findByName($name);
		if (empty($param)) {
			$param = new Parameter();
			$param->setName($name);
			$this->parameters->add($param);
		}

		return $param;
	}

	/**
	 * Searches whether a parameter with the given unique combination exists
	 *
	 * @param string $name
	 * @param string $id
	 * @return bool
	 */
	public function search($name, $in) {
		return $this->parameters->search(function (Parameter $param) use ($name, $in) {
			return $param->getIn() == $in && $param->getName() == $name;
		});
	}

	public function find($name, $in) {
		foreach ($this->parameters as $param) {
			if ($param->getIn() == $in && $param->getName() == $name) {
				return $param;
			}
		}
	}

	public function get($name, $in) {
		$param = $this->find($name, $in);
		if (empty($param)) {
			$param = new Parameter();
			$param->setName($name);
			$param->setIn($in);
			$this->parameters->add($param);
		}

		return $param;
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
	 * @return bool
	 */
	public function contains(Parameter $param) {
		return $this->parameters->contains($param);
	}

	public function current() {
		return $this->parameters->current();
	}

	public function key() {
		return $this->parameters->key();
	}

	public function next() {
		return $this->parameters->next();
	}

	public function rewind() {
		return $this->parameters->rewind();
	}

	public function valid() {
		return $this->parameters->valid();
	}
}
