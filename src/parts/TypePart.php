<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait TypePart {
	
	/** @var string */
	private $type;
	
	/** @var string */
	private $format;
	
	/** @var string */
	private $collectionFormat;
	
	/** @var mixed */
	private $default;

	/** @var float */
	private $maximum;
	
	/** @var boolean */
	private $exclusiveMaximum = false;
	
	/** @var float */
	private $minimum;
	
	/** @var boolean */
	private $exclusiveMinimum = false;
	
	/** @var int */
	private $maxLength;
	
	/** @var int */
	private $minLength;
	
	/** @var string */
	private $pattern;
	
	/** @var int */
	private $maxItems;
	
	/** @var int */
	private $minItems;
	
	/** @var boolean */
	private $uniqueItems;
	
	/** @var mixed */
	private $enum;
	
	/** @var float */
	private $multipleOf;
	
	private function parseType(Map $data) {
		$this->format = $data->get('format');
		$this->collectionFormat = $data->get('collectionFormat');
		$this->default = $data->get('default');
		$this->maximum = $data->get('maximum');
		$this->exclusiveMaximum = $data->has('exclusiveMaximum') && $data->get('exclusiveMaximum');
		$this->minimum = $data->get('minimum');
		$this->exclusiveMinimum = $data->has('exclusiveMinimum') && $data->get('exclusiveMinimum');
		$this->maxLength = $data->get('maxLength');
		$this->minLength = $data->get('minLength');
		$this->pattern = $data->get('pattern');
		$this->maxItems = $data->get('maxItems');
		$this->minItems = $data->get('minItems');
		$this->uniqueItems = $data->has('uniqueItems') && $data->get('uniqueItems');
		$this->enum = $data->get('enum');
		$this->multipleOf = $data->get('multipleOf');
	}

	/**
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 *
	 * @param string $type
	 * @return $this
	 */
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getFormat() {
		return $this->format;
	}
	
	/**
	 * Sets the extending format for the type
	 *
	 * @param string $format
	 * @return $this
	 */
	public function setFormat($format) {
		$this->format = $format;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getCollectionFormat() {
		return $this->collectionFormat;
	}
	
	/**
	 * Determines the format of the array if type array is used. Possible values are:
	 * 
	 * - `csv` - comma separated values `foo,bar`.
	 * - `ssv` - space separated values `foo bar`.
	 * - `tsv` - tab separated values `foo\tbar`.
	 * - `pipes` - pipe separated values `foo|bar`.
	 * - `multi` - corresponds to multiple parameter instances instead of multiple values for a 
	 * single instance `foo=bar&foo=baz`. This is valid only for parameters in "query" or "formData".
	 * 
	 * Default value is `csv`.
	 * 
	 * 
	 * @param string $collectionFormat
	 * @return $this
	 */
	public function setCollectionFormat($collectionFormat) {
		$this->collectionFormat = $collectionFormat;
		return $this;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getDefault() {
		return $this->default;
	}
	
	/**
	 *
	 * @param mixed $default
	 * @return $this
	 */
	public function setDefault($default) {
		$this->default = $default;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getMaximum() {
		return $this->maximum;
	}
	
	/**
	 *
	 * @param float $maximum
	 * @return $this
	 */
	public function setMaximum($maximum) {
		$this->maximum = $maximum;
		return $this;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public function isExclusiveMaximum() {
		return $this->exclusiveMaximum;
	}
	
	/**
	 *
	 * @param boolean $exclusiveMaximum
	 * @return $this
	 */
	public function setExclusiveMaximum($exclusiveMaximum) {
		$this->exclusiveMaximum = $exclusiveMaximum;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getMinimum() {
		return $this->minimum;
	}
	
	/**
	 *
	 * @param float $minimum
	 * @return $this
	 */
	public function setMinimum($minimum) {
		$this->minimum = $minimum;
		return $this;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public function isExclusiveMinimum() {
		return $this->exclusiveMinimum;
	}
	
	/**
	 *
	 * @param boolean $exclusiveMinimum
	 * @return $this
	 */
	public function setExclusiveMinimum($exclusiveMinimum) {
		$this->exclusiveMinimum = $exclusiveMinimum;
		return $this;
	}
	
	/**
	 *
	 * @return int
	 */
	public function getMaxLength() {
		return $this->maxLength;
	}
	
	/**
	 *
	 * @param int $maxLength
	 * @return $this
	 */
	public function setMaxLength($maxLength) {
		$this->maxLength = $maxLength;
		return $this;
	}
	
	/**
	 *
	 * @return int
	 */
	public function getMinLength() {
		return $this->minLength;
	}
	
	/**
	 *
	 * @param int $minLength
	 * @return $this
	 */
	public function setMinLength($minLength) {
		$this->minLength = $minLength;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getPattern() {
		return $this->pattern;
	}
	
	/**
	 *
	 * @param string $pattern
	 * @return $thi
	 */
	public function setPattern($pattern) {
		$this->pattern = $pattern;
		return $this;
	}
	
	/**
	 *
	 * @return int
	 */
	public function getMaxItems() {
		return $this->maxItems;
	}
	
	/**
	 *
	 * @param int $maxItems
	 * @return $this
	 */
	public function setMaxItems($maxItems) {
		$this->maxItems = $maxItems;
		return $this;
	}
	
	/**
	 *
	 * @return int
	 */
	public function getMinItems() {
		return $this->minItems;
	}
	
	/**
	 *
	 * @param int $minItems
	 * @return $this
	 */
	public function setMinItems($minItems) {
		$this->minItems = $minItems;
		return $this;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public function hasUniqueItems() {
		return $this->uniqueItems;
	}
	
	/**
	 *
	 * @param boolean $uniqueItems
	 * @return $this
	 */
	public function setUniqueItems($uniqueItems) {
		$this->uniqueItems = $uniqueItems;
		return $this;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getEnum() {
		return $this->enum;
	}
	
	/**
	 *
	 * @param mixed $enum
	 * @return $this
	 */
	public function setEnum($enum) {
		$this->enum = $enum;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getMultipleOf() {
		return $this->multipleOf;
	}
	
	/**
	 *
	 * @param float $multipleOf
	 * @return $this
	 */
	public function setMultipleOf($multipleOf) {
		$this->multipleOf = $multipleOf;
		return $this;
	}
	
	
	
	
}