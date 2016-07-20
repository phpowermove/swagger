<?php
namespace gossi\swagger\parts;

use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;

trait UrlPart {

	/** @var string */
	private $url;

	private function parseUrl(Map $data) {
		$this->url = $data->get('url');
	}

	private function mergeUrl(static $model, $overwrite = false) {
		MergeHelper::mergeFields($this->url, $model->url, $overwrite);
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
