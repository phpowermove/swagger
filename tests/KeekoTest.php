<?php
namespace gossi\swagger\tests;

use gossi\swagger\Swagger;
use phootwork\json\Json;
use phootwork\file\exception\FileNotFoundException;
use phootwork\file\File;

class KeekoTest extends \PHPUnit_Framework_TestCase {
	
	private function fileToArray($filename) {
		$file = new File($filename);
		
		if (!$file->exists()) {
			throw new FileNotFoundException(sprintf('File not found at: %s', $filename));
		}
		
		return Json::decode($file->read());
	}
	
	public function testUser() {
		$filename = __DIR__ . '/fixtures/keeko-user.json';
		$swagger = Swagger::fromFile($filename);
		
		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());	
	}
}