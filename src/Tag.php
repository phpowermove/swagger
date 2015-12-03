<?php
namespace gossi\swagger;

use phootwork\collection\CollectionUtils;
use gossi\swagger\parts\ExtensionPart;

class Tag {
	
	use ExtensionPart;
	
	/** @var string */
	private $name;
	
	/** @var string */
	private $description;
	
	/** @var ExternalDocs */
	private $externalDocs;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);
		
		$this->name = $data->get('name');
		$this->description = $data->get('description');
		
		if ($data->has('externalDocs')) {
			$this->externalDocs = new ExternalDocs($data->get('externalDocs'));
		}
		
		// extensions
		$this->parseExtensions($data);
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
	 * @return ExternalDocs
	 */
	public function getExternalDocs() {
		return $this->externalDocs;
	}
	
	/**
	 *
	 * @param ExternalDocs $externalDocs        	
	 */
	public function setExternalDocs(ExternalDocs $externalDocs) {
		$this->externalDocs = $externalDocs;
		return $this;
	}
	
}