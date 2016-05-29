<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait UrlPart {

	/** @var string */
	private $url = false;

	private function parseUrl(Map $data) {
		$this->url = $data->get('url');
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
