<?php
namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\util\MergeHelper;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Contact extends AbstractModel implements Arrayable {

	use ExtensionPart;

	/** @var string */
	private $name;

	/** @var string */
	private $url;

	/** @var string */
	private $email;

	public function __construct($contents = []) {
		$this->parse($contents);
	}

	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);

		$this->name = $data->get('name');
		$this->url = $data->get('url');
		$this->email = $data->get('email');

		// extensions
		$this->parseExtensions($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function merge(static $model, $overwrite = false) {
		MergeHelper::mergeFields($this->name, $model->name, $overwrite);
		MergeHelper::mergeFields($this->url, $model->url, $overwrite);
		MergeHelper::mergeFields($this->email, $model->email, $overwrite);

		$this->mergeExtensions($model, $overwrite);
	}

	public function toArray() {
		return $this->export('name', 'url', 'email');
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

	/**
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 *
	 * @param string $email
	 * @return $this
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

}
