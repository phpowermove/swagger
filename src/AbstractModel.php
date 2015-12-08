<?php
namespace gossi\swagger;

abstract class AbstractModel {
	
	protected function export() {
		$cols = func_get_args();
		
		// add cols
		if (method_exists($this, 'hasRef') && $this->hasRef()) {
			$cols = array_merge(['$ref'], $cols);
		}
		
		// flatten array
		$fields = [];
		array_walk_recursive($cols, function($a) use (&$fields) { $fields[] = $a; });

		$out = [];
		$refl = new \ReflectionClass(get_class($this));
		
		foreach ($fields as $field) {
			if ($field == 'tags') {
				$val = $this->exportTags();
			} else {
				$prop = $refl->getProperty($field == '$ref' ? 'ref' : $field);
				$prop->setAccessible(true);
				$val = $prop->getValue($this);
				
				if (method_exists($val, 'toArray')) {
					$val = $val->toArray();
				}
			}
			
			if ($field == 'required' && is_bool($val) || !empty($val)) {
				$out[$field] = $val;
			}
		}
		
		if (method_exists($this, 'getExtensions')) {
			$out = array_merge($out, $this->getExtensions()->toArray());
		}
		
		return $out;
	}
}