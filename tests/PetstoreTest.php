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
		
		$responses = $swagger->getPaths()->get('/pets')->getOperation('get')->getResponses();
		$headers = $responses->get('200')->getHeaders();
		
		$this->assertEquals(1, $headers->size());
		$this->assertTrue($headers->has('x-expires'));
		$expires = $headers->get('x-expires');
		$this->assertTrue($headers->contains($expires));
		
		$this->assertEquals('x-expires', $expires->getHeader());
		$this->assertEquals('string', $expires->getType());
		
		$headers->remove('x-expires');
		$this->assertEquals(0, $headers->size());
		$this->assertFalse($headers->has('x-expires'));
		
		$headers->add($expires);
		$this->assertEquals(1, $headers->size());
		$this->assertTrue($headers->has('x-expires'));
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
		
		$external = $swagger->getExternalDocs();
		$this->assertEquals('find more info here', $external->getDescription());
		$this->assertEquals('https://swagger.io/about', $external->getUrl());
		
		$info = $swagger->getInfo();
		$this->assertEquals('1.0.0', $info->getVersion());
		$this->assertEquals('Swagger Petstore', $info->getTitle());
		$this->assertEquals('A sample API that uses a petstore as an example to demonstrate features in the swagger-2.0 specification', $info->getDescription());
		$this->assertEquals('http://swagger.io/terms/', $info->getTerms());
		
		$this->assertEquals('1.0.1', $info->setVersion('1.0.1')->getVersion());
		$this->assertEquals('Pets', $info->setTitle('Pets')->getTitle());
		$this->assertEquals('desc', $info->setDescription('desc')->getDescription());
		$this->assertEquals('T-O-S', $info->setTerms('T-O-S')->getTerms());
		
		$contact = $info->getContact();
		$this->assertEquals('Swagger API Team', $contact->getName());
		$this->assertEquals('apiteam@swagger.io', $contact->getEmail());
		$this->assertEquals('http://swagger.io', $contact->getUrl());
		
		$this->assertEquals('Swaggers', $contact->setName('Swaggers')->getName());
		$this->assertEquals('team@swagger.io', $contact->setEmail('team@swagger.io')->getEmail());
		$this->assertEquals('https://swagger.io', $contact->setUrl('https://swagger.io')->getUrl());
		
		$license = $info->getLicense();
		$this->assertEquals('MIT', $license->getName());
		$this->assertEquals('http://github.com/gruntjs/grunt/blob/master/LICENSE-MIT', $license->getUrl());
		
		$this->assertEquals('APL', $license->setName('APL')->getName());
		$this->assertEquals('https://www.apache.org/licenses/LICENSE-2.0', $license->setUrl('https://www.apache.org/licenses/LICENSE-2.0')->getUrl());
		
	}
}