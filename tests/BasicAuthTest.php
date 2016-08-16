<?php
namespace gossi\swagger\tests;

use gossi\swagger\Swagger;
use phootwork\file\exception\FileNotFoundException;
use phootwork\file\File;
use phootwork\json\Json;

class BasicAuth extends \PHPUnit_Framework_TestCase {

	private function fileToArray($filename) {
		$file = new File($filename);

		if (!$file->exists()) {
			throw new FileNotFoundException(sprintf('File not found at: %s', $filename));
		}

		return Json::decode($file->read());
	}

	public function testUser() {
		$filename = __DIR__ . '/fixtures/basic-auth.json';
		$swagger = Swagger::fromFile($filename);

		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
	}
}
