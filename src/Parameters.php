<?php
namespace gossi\swagger;

use gossi\swagger\parts\RefPart;
use phootwork\collection\ArrayList;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Parameters extends ArrayList implements Arrayable {
	
	use RefPart;
	
	public function __construct($contents = []) {
		$this->parse($contents);
	}
	
	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);
		
		$this->parseRef($data);

		if (!$this->hasRef()) {
			foreach ($data as $param) {
				$this->add(new Parameter($param));
			}
		}
		
	}
	
	public function toArray() {
		if ($this->hasRef()) {
			return ['$ref' => $this->getRef()];
		}
		
		return parent::toArray();
	}

	/**
	 * Find parameter by name
	 * 
	 * @param string $name
	 * @return Parameter
	 */
	public function findByName($name) {
		return $this->search($name, function(Parameter $param, $name) {
			return $param->getName() == $name;
		});
	}
}
