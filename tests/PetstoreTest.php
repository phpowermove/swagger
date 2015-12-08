<?php
namespace gossi\swagger\tests;

use gossi\swagger\Swagger;
use phootwork\json\Json;
use phootwork\file\exception\FileNotFoundException;
use phootwork\file\File;

class PetstoreTest extends \PHPUnit_Framework_TestCase {
	
	private function fileToArray($filename) {
		$file = new File($filename);
		
		if (!$file->exists()) {
			throw new FileNotFoundException(sprintf('File not found at: %s', $filename));
		}
		
		return Json::decode($file->read());
	}
	
	public function testMinimal() {
		$filename = __DIR__ . '/fixtures/petstore-minimal.json';
		
		$swagger = Swagger::fromFile($filename);
		
		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
	}
	
	public function testSimple() {
		$filename = __DIR__ . '/fixtures/petstore-simple.json';
		
		$swagger = Swagger::fromFile($filename);
		
		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
	}
	
	public function testPetstore() {
		$filename = __DIR__ . '/fixtures/petstore.json';
		
		$swagger = Swagger::fromFile($filename);
		
		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
	}
	
	public function testExpanded() {
		$filename = __DIR__ . '/fixtures/petstore-expanded.json';
	
		$swagger = Swagger::fromFile($filename);

		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
	}
	
	public function testExternalDocs() {
		$filename = __DIR__ . '/fixtures/petstore-with-external-docs.json';
	
		$swagger = Swagger::fromFile($filename);
	
		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
	}
}