<?php
namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ItemsPart;
use gossi\swagger\parts\RefPart;
use gossi\swagger\parts\RequiredPart;
use gossi\swagger\parts\SchemaPart;
use gossi\swagger\parts\TypePart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Parameter extends AbstractModel implements Arrayable {

	use RefPart;
	use DescriptionPart;
	use SchemaPart;
	use TypePart;
	use ItemsPart;
	use RequiredPart;
	use ExtensionPart;

	/** @var string */
	private $name;

	/** @var string */
	private $in;

	/** @var bool */
	private $allowEmptyValue = false;

	public function __construct($contents = []) {
		$this->parse($contents);
	}

	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		$this->name = $data->get('name');
		$this->in = $data->get('in');
		$this->allowEmptyValue = $data->has('allowEmptyValue') && $data->get('allowEmptyValue');

		// parts
		$this->parseRef($data);
		$this->parseDescription($data);
		$this->parseSchema($data);
		$this->parseRequired($data);
		$this->parseType($data);
		$this->parseItems($data);
		$this->parseExtensions($data);
	}

	public function toArray() {
		return $this->export('name', 'in', 'allowEmptyValue', 'required', 'description', 'schema',
				$this->getTypeExportFields(), 'items');
	}

	/**
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getIn() {
		return $this->in;
	}

	/**
	 *
	 * @param string $in
	 */
	public function setIn($in) {
		$this->in = $in;
		return $this;
	}

	/**
	 *
	 * @return bool
	 */
	public function getAllowEmptyValue() {
		return $this->allowEmptyValue;
	}

	/**
	 * Sets the ability to pass empty-valued parameters. This is valid only for either `query` or 
	 * `formData` parameters and allows you to send a parameter with a name only or an empty value. 
	 * Default value is `false`.
	 * 
	 * @param bool $allowEmptyValue
	 */
	public function setAllowEmptyValue($allowEmptyValue) {
		$this->allowEmptyValue = $allowEmptyValue;
		return $this;
	}

}
