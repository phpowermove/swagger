<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class License implements Arrayable {
	
	use ExtensionPart;
	
	/** @var string */
	private $name;
	
	/** @var string */
	private $url;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);
	
		$this->name = $data->get('name');
		$this->url = $data->get('url');
	
		// extensions
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		
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
	 * @return $this
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	
}