<?php
namespace gossi\swagger;

use phootwork\lang\Arrayable;
use gossi\swagger\parts\DescriptionPart;
use phootwork\collection\Map;
use phootwork\collection\CollectionUtils;

class SecurityScheme extends AbstractModel implements Arrayable {
	
	use DescriptionPart;
	
	/** @var string */
	private $id;

	/** @var string */
	private $name;

	/** @var string */
	private $type;
	
	/** @var string */
	private $in;
	
	/** @var string */
	private $flow;
	
	/** @var string */
	private $authorizationUrl;
	
	/** @var string */
	private $tokenUrl;
	
	/** @var Map */
	private $scopes;

	/**
	 * @param string $id
	 * @param array $contents
	 */
	public function __construct($id, $contents = []) {
		$this->id = $id;
		$this->parse($contents);
	}

	/**
	 * @param array $contents
	 */
	private function parse($contents = []) {
		$data = CollectionUtils::toMap($contents);
		
		$this->type = $data->get('type');
		$this->name = $data->get('name');
		$this->in = $data->get('in');
		$this->flow = $data->get('flow');
		$this->authorizationUrl = $data->get('authorizationUrl');
		$this->tokenUrl = $data->get('tokenUrl');
		$this->scopes = $data->get('scopes', new Map());
		
		$this->parseDescription($data);
	}

	/**
	 * @return array
	 */
	public function toArray() {
		return $this->export('type', 'description', 'name', 'in', 'flow', 
			'authorizationUrl', 'tokenUrl', 'scopes');
	}
	
	/**
	 * Returns the id for this security scheme
	 * 
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Return the name of the header or query parameter to be used
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Sets the name of the header or query parameter to be used
	 *
	 * @param string $name
	 * @return $this
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * Returns the type of the security scheme
	 * 
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type of the security scheme
	 * 
	 * @param string $type Valid values are "basic", "apiKey" or "oauth2"
	 * @return $this
	 */
	public function setType($type) {
		$this->type = $type;
		return $this;
	}

	/**
	 * Returns the location of the API key
	 * 
	 * @return string
	 */
	public function getIn() {
		return $this->in;
	}

	/**
	 * Sets the location of the API key
	 * 
	 * @param string $in Valid values are "query" or "header"
	 * @return $this
	 */
	public function setIn($in) {
		$this->in = $in;
		return $this;
	}

	/**
	 * Retunrs the flow used by the OAuth2 security scheme
	 *  
	 * @return string
	 */
	public function getFlow() {
		return $this->flow;
	}

	/**
	 * Sets the flow used by the OAuth2 security scheme
	 * 
	 * @param string $flow Valid values are "implicit", "password", "application" or "accessCode"
	 * @return $this
	 */
	public function setFlow($flow) {
		$this->flow = $flow;
		return $this;
	}

	/**
	 * Returns the authorization URL to be used for this flow
	 * 
	 * @return string
	 */
	public function getAuthorizationUrl() {
		return $this->authorizationUrl;
	}

	/**
	 * Sets the authorization URL to be used for this flow
	 * 
	 * @param string $authorizationUrl
	 * @return $this
	 */
	public function setAuthorizationUrl($authorizationUrl) {
		$this->authorizationUrl = $authorizationUrl;
		return $this;
	}

	/**
	 * Returns the token URL to be used for this flow
	 * 
	 * @return string
	 */
	public function getTokenUrl() {
		return $this->tokenUrl;
	}

	/**
	 * Sets the token URL to be used for this flow
	 * 
	 * @param string $tokenUrl
	 * @return $this
	 */
	public function setTokenUrl($tokenUrl) {
		$this->tokenUrl = $tokenUrl;
		return $this;
	}
	
	/**
	 * Returns the scopes
	 * 
	 * @return Map
	 */
	public function getScopes() {
		return $this->scopes;
	}

}
