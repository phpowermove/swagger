<?php
namespace gossi\swagger\parts;

use phootwork\collection\Map;
use gossi\swagger\Schema;

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