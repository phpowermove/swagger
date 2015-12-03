<?php
namespace gossi\swagger;

use gossi\swagger\parts\ConsumesPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use gossi\swagger\parts\ProducesPart;
use phootwork\collection\CollectionUtils;
use gossi\swagger\tags\TagsPart;
use gossi\swagger\parameters\ParametersPart;
use gossi\swagger\responses\ResponsesPart;
use phootwork\lang\Arrayable;

class Operation implements Arrayable {
	
	use ConsumesPart;
	use ProducesPart;
	use TagsPart;
	use ParametersPart;
	use ResponsesPart;
	use ExternalDocsPart;
	use ExtensionPart;
	
	/** @var string */
	private $summary;
	
	/** @var string */
	private $description;
	
	/** @var string */
	private $operationId;
	
	/** @var boolean */
	private $deprecated = false;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		$this->summary = $data->get('summary');
		$this->description = $data->get('description');
		$this->operationId = $data->get('operationId');
		$this->deprecated = $data->has('deprecated') && $data->get('deprecated');

		// parts
		$this->parseConsumes($data);
		$this->parseProduces($data);
		$this->parseTags($data);
		$this->parseParameters($data);
		$this->parseResponses($data);
		$this->parseExternalDocs($data);
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getSummary() {
		return $this->summary;
	}
	
	/**
	 *
	 * @param string $summary
	 * @return $this
	 */
	public function setSummary($summary) {
		$this->summary = $summary;
		return $this;
	}

	/**
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 *
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getOperationId() {
		return $this->operationId;
	}
	
	/**
	 *
	 * @param string $operationId
	 * @return $this
	 */
	public function setOperationId($operationId) {
		$this->operationId = $operationId;
		return $this;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public function getDeprecated() {
		return $this->deprecated;
	}
	
	/**
	 *
	 * @param boolean $deprecated
	 * @return $this
	 */
	public function setDeprecated($deprecated) {
		$this->deprecated = $deprecated;
		return $this;
	}
	
	
}