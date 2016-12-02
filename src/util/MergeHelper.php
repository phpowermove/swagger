<?php
namespace gossi\swagger\util;

use phootwork\collection\Map;
use phootwork\collection\Set;

/**
 * @internal
 */
class MergeHelper {
    /**
     * @param string|integer|null|Map|Set $original
     * @param string|integer|null|Map|Set $external
     * @param bool                $overwrite
     */
    public static function mergeFields(&$original, $external, $overwrite) {
        if ($original instanceof Map) {
            foreach ($external as $key => $value) {
                if ($overwrite || !$original->has($key)) {
                    $original->set($key, $value);
                }
            }
        } elseif ($original instanceof Set) {
            foreach ($external as $value) {
                $original->add($value);
            }
        } else { // if scalar
            if ($overwrite) {
                $original = null !== $external ? $external : $original;
            } else {
                $original = null === $original ? $external : $original;
            }
        }
    }
}
