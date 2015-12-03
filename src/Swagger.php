<?php
namespace gossi\swagger;

use gossi\swagger\parts\ConsumesPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use gossi\swagger\parts\ParametersPart;
use gossi\swagger\parts\ProducesPart;
use gossi\swagger\parts\ResponsesPart;
use gossi\swagger\parts\SchemesPart;
use gossi\swagger\parts\TagsPart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\file\exception\FileNotFoundException;
use phootwork\file\File;
use phootwork\json\Json;
use phootwork\lang\Arrayable;

class Swagger implements Arrayable {

	use SchemesPart;
	use ConsumesPart;
	use ProducesPart;
	use TagsPart;
	use ParametersPart;
	use ResponsesPart;
	use ExternalDocsPart;
	use ExtensionPart;
	
	/** @var string */
	private $version = '2.0';
	
	/** @var Info */
	private $info;
	
	/** @var string */
	private $host;
	
	/** @var string */
	private $basePath;	
	
	/** @var Paths */
	private $paths;
	
	/** @var Definitions */
	private $definitions;
	
	/** @var Map */
	private $securityDefinitions;
	
	/**
	 *
	 * @param string $filename
	 * @throws FileNotFoundException
	 * @throws JsonException
	 * @return static
	 */
	public static function fromFile($filename) {
		$file = new File($filename);
	
		if (!$file->exists()) {
			throw new FileNotFoundException(sprintf('File not found at: %s', $filename));
		}

		$json = Json::decode($file->read());

		return new static($json);
	}
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);
		
		$this->version = $data->get('version', $this->version);
		$this->host = $data->get('host');
		$this->basePath = $data->get('basePath');
		$this->info = new Info($data->get('info', []));
		$this->paths = new Paths($data->get('paths', new Map()));
		$this->definitions = new Definitions($data->get('definitions', new Map()));
		
		// security schemes
		$this->securityDefinitions = $data->get('securityDefinitions', new Map());
		foreach ($this->securityDefinitions as $s => $def) {
			$this->securityDefinitions->set($s, new SecurityScheme($s, $def));
		}

		// parts
		$this->parseSchemes($data);
		$this->parseConsumes($data);
		$this->parseProduces($data);
		$this->parseTags($data);
		$this->parseParameters($data);
		$this->parseResponses($data);
		$this->parseExternalDocs($data);
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		
	}
	
	/**
	 *
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}
	
	/**
	 *
	 * @param string $version
	 * @return $this
	 */
	public function setVersion($version) {
		$this->version = $version;
		return $this;
	}
	
	/**
	 *
	 * @return Info
	 */
	public function getInfo() {
		return $this->info;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getHost() {
		return $this->host;
	}
	
	/**
	 *
	 * @param string $host
	 * @return $this
	 */
	public function setHost($host) {
		$this->host = $host;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getBasePath() {
		return $this->basePath;
	}
	
	/**
	 *
	 * @param string $basePath
	 * @return $this
	 */
	public function setBasePath($basePath) {
		$this->basePath = $basePath;
		return $this;
	}
	
	/**
	 *
	 * @return Paths
	 */
	public function getPaths() {
		return $this->paths;
	}
	
	/**
	 *
	 * @return Map
	 */
	public function getDefinitions() {
		return $this->definitions;
	}

	/**
	 *
	 * @return Map
	 */
	public function getSecurityDefinitions() {
		return $this->securityDefinitions;
	}
	
// 	/**
// 	 *
// 	 * @param Map $securityDefinitions        	
// 	 */
// 	public function setSecurityDefinitions(Map $securityDefinitions) {
// 		$this->securityDefinitions = $securityDefinitions;
// 		return $this;
// 	}

	
}