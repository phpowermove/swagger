<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class ExternalDocs extends AbstractModel implements Arrayable {
	
	use ExtensionPart;
	
	/** @var string */
	private $description;
	
	/** @var string */
	private $url;

	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);
	
		$this->description = $data->get('description');
		$this->url = $data->get('url');
	
		// parts
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		return $this->export('description', 'url');
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