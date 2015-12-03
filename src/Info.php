<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;

class Info implements Arrayable {
	
	use ExtensionPart;
	
	/** @var string */
	private $title;
	
	/** @var string */	
	private $description;
	
	/** @var string */
	private $terms;
	
	/** @var Contact */
	private $contact;
	
	/** @var License */
	private $license;
	
	/** @var string */
	private $version;

	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);
	
		$this->title = $data->get('title');
		$this->description = $data->get('description');
		$this->terms = $data->get('terms');
		$this->contact = new Contact($data->get('contact', new Map()));
		$this->license = new License($data->get('license', new Map()));
		$this->version = $data->get('version');
		
		// extensions
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		
	}
	
	/**
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 *
	 * @param string $title
	 * @return $this
	 */
	public function setTitle($title) {
		$this->title = $title;
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
	 * @return $this
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getTerms() {
		return $this->terms;
	}
	
	/**
	 *
	 * @param string $terms
	 * @return $this
	 */
	public function setTerms($terms) {
		$this->terms = $terms;
		return $this;
	}
	
	/**
	 *
	 * @return Contact
	 */
	public function getContact() {
		return $this->contact;
	}
	
	/**
	 *
	 * @return License
	 */
	public function getLicense() {
		return $this->license;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 *
	 * @param string $version
	 * @return $this
	 */
	public function setVersion($version) {
		$this->version = $version;
		return $this;
	}

}