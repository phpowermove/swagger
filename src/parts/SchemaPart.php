<?php
namespace gossi\swagger\parts;

use gossi\swagger\Schema;
use phootwork\collection\Map;

trait SchemaPart {

	/** @var Schema */
	private $schema;

	private function parseSchema(Map $data) {
		$this->schema = new Schema($data->get('schema'));
	}

	/**
	 *
	 * @return Schema
	 */
	public function getSchema() {
		return $this->schema;
	}
}
