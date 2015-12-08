<?php
namespace gossi\swagger\tests;

use gossi\swagger\Swagger;

class SwaggerTest extends \PHPUnit_Framework_TestCase {
	
	public function testVersion() {
		$swagger = new Swagger();
		$this->assertEquals('2.0', $swagger->getVersion());
	}
	
	public function testBasics() {
		$swagger = new Swagger();
		$swagger->setBasePath('/api');
		$swagger->setHost('http://example.com');
		$swagger->setVersion('2.1');
		
		$this->assertEquals('/api', $swagger->getBasePath());
		$this->assertEquals('http://example.com', $swagger->getHost());
		$this->assertEquals('2.1', $swagger->getVersion());
		
		$this->assertEquals([
			'swagger' => '2.1',
			'host' => 'http://example.com',
			'basePath' => '/api'
		], $swagger->toArray());
	}
}