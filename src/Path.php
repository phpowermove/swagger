<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Path extends AbstractModel implements Arrayable {

	use ExtensionPart;

	private $operations;

	/** @var string */
	private $path;

	public function __construct($path, $contents = []) {
		$this->path = $path;
		$this->operations = new Map();
		$this->parse($contents);
	}

	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);

		foreach (Swagger::$METHODS as $method) {
			if ($data->has($method)) {
				$this->operations->set($method, new Operation($data->get($method)));
			}
		}

		// parts
		$this->parseExtensions($data);
	}

	public function toArray() {
		return array_merge(
			CollectionUtils::toArrayRecursive($this->operations),
			CollectionUtils::toArrayRecursive($this->getExtensions())
		);
	}

	/**
	 * Returns this path
	 *
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * Gets the operation for the given method, creates one if none exists
	 *
	 * @param string $method
	 * @return Operation
	 */
	public function getOperation($method) {
		if (!$this->operations->has($method)) {
			$this->operations->set($method, new Operation());
		}

		return $this->operations->get($method);
	}

	/**
	 * Sets the operation for a method
	 *
	 * @param string $method
	 * @param Operation $operation
	 */
	public function setOperation($method, Operation $operation) {
		$this->operations->set($method, $operation);
	}

	/**
	 *
	 * @param string $method
	 * @return bool
	 */
	public function hasOperation($method) {
		return $this->operations->has($method);
	}

	/**
	 * Removes an operation for the given method
	 *
	 * @param string $method
	 */
	public function removeOperation($method) {
		$this->operations->remove($method);
	}

	/**
	 * Returns all methods for this path
	 *
	 * @return Set
	 */
	public function getMethods() {
		return $this->operations->keys();
	}

}
