<?php
namespace gossi\swagger\tests;

use gossi\swagger\Swagger;
use phootwork\file\exception\FileNotFoundException;
use phootwork\file\File;
use phootwork\json\Json;

class SecurityTest extends \PHPUnit_Framework_TestCase {

	private function fileToArray($filename) {
		$file = new File($filename);

		if (!$file->exists()) {
			throw new FileNotFoundException(sprintf('File not found at: %s', $filename));
		}

		return Json::decode($file->read());
	}

	public function testBasicAuth() {
		$filename = __DIR__ . '/fixtures/basic-auth.json';
		$swagger = Swagger::fromFile($filename);

		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
	}
	
	public function testSecurityDefinitions() {
		$filename = __DIR__ . '/fixtures/security-definitions.json';
		$swagger = Swagger::fromFile($filename);
		$this->assertEquals($this->fileToArray($filename), $swagger->toArray());
		
		$definitions = $swagger->getSecurityDefinitions();
		
		$oauth = $definitions->get('OauthSecurity');
		$this->assertEquals('oauth2', $oauth->getType());
		$this->assertEquals('accessCode', $oauth->getFlow());
		$this->assertEquals('https://oauth.simple.api/authorization', $oauth->getAuthorizationUrl());
		$this->assertEquals('https://oauth.simple.api/token', $oauth->getTokenUrl());
		$this->assertEquals([
			'admin' => 'Admin scope',
			'user' => 'User scope'
		], $oauth->getScopes()->toArray());
		
		$this->assertTrue($definitions->has('MediaSecurity'));
		$this->assertTrue($definitions->has('LegacySecurity'));
		$definitions->remove('LegacySecurity');
		$this->assertFalse($definitions->has('LegacySecurity'));
	}
}
