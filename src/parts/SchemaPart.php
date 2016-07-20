<?php
namespace gossi\swagger\parts;

use gossi\swagger\Schema;
use gossi\swagger\util\MergeHelper;
use phootwork\collection\Map;

trait SchemaPart {

	/** @var Schema */
	private $schema;

	private function parseSchema(Map $data) {
		$this->schema = new Schema($data->get('schema'));
	}

	private function mergeSchema(static $model, $overwrite = false) {
		$this->schema->merge($model->schema, $overwrite);
	}

	/**
	 *
	 * @return Schema
	 */
	public function getSchema() {
		return $this->schema;
	}
}
