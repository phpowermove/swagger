<?php
namespace gossi\swagger;

use gossi\swagger\collections\Definitions;
use gossi\swagger\collections\Paths;
use gossi\swagger\collections\SecurityDefinitions;
use gossi\swagger\parts\ConsumesPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use gossi\swagger\parts\ParametersPart;
use gossi\swagger\parts\ProducesPart;
use gossi\swagger\parts\ResponsesPart;
use gossi\swagger\parts\SchemesPart;
use gossi\swagger\parts\SecurityPart;
use gossi\swagger\parts\TagsPart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\file\File;
use phootwork\file\exception\FileNotFoundException;
use phootwork\json\Json;
use phootwork\json\JsonException;
use phootwork\lang\Arrayable;

class Swagger extends AbstractModel implements Arrayable {

	use SchemesPart;
	use ConsumesPart;
	use ProducesPart;
	use TagsPart;
	use ParametersPart;
	use ResponsesPart;
	use ExternalDocsPart;
	use ExtensionPart;
	use SecurityPart;

	const T_INTEGER = 'integer';
	const T_NUMBER = 'number';
	const T_BOOLEAN = 'boolean';
	const T_STRING = 'string';
	const T_FILE = 'file';

	const F_INT32 = 'int32';
	const F_INT64 = 'int64';
	const F_FLOAT = 'float';
	const F_DOUBLE = 'double';
	const F_STRING = 'string';
	const F_BYTE = 'byte';
	const F_BINARY = 'binary';
	const F_DATE = 'date';
	const F_DATETIME = 'date-time';
	const F_PASSWORD = 'password';

	public static $METHODS = ['get', 'post', 'put', 'patch', 'delete', 'options', 'head'];

	/** @var string */
	private $swagger = '2.0';

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

	/** @var SecurityDefinitions */
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

		$this->swagger = $data->get('version', $this->swagger);
		$this->host = $data->get('host');
		$this->basePath = $data->get('basePath');
		$this->info = new Info($data->get('info', []));
		$this->paths = new Paths($data->get('paths'));
		$this->definitions = new Definitions($data->get('definitions', new Map()));
		$this->securityDefinitions = new SecurityDefinitions($data->get('securityDefinitions', new Map()));

		// parts
		$this->parseSchemes($data);
		$this->parseConsumes($data);
		$this->parseProduces($data);
		$this->parseTags($data);
		$this->parseParameters($data);
		$this->parseResponses($data);
		$this->parseSecurity($data);
		$this->parseExternalDocs($data);
		$this->parseExtensions($data);
	}

	public function toArray() {
		return $this->export('swagger', 'info', 'host', 'basePath', 'schemes', 'consumes', 'produces',
			'paths', 'definitions', 'parameters', 'responses', 'securityDefinitions', 'security', 
			'tags', 'externalDocs'
		);
	}

	/**
	 *
	 * @return string
	 */
	public function getVersion() {
		return $this->swagger;
	}

	/**
	 *
	 * @param string $version
	 * @return $this
	 */
	public function setVersion($version) {
		$this->swagger = $version;
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
	 * @return Definitions
	 */
	public function getDefinitions() {
		return $this->definitions;
	}

	/**
	 *
	 * @return SecurityDefinitions
	 */
	public function getSecurityDefinitions() {
		return $this->securityDefinitions;
	}

}
