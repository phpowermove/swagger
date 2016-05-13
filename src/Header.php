<?php

namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ItemsPart;
use gossi\swagger\parts\TypePart;
use phootwork\collection\CollectionUtils;
use gossi\swagger\parts\ExtensionPart;
use phootwork\lang\Arrayable;
use phootwork\collection\Map;

class Header extends AbstractModel implements Arrayable
{
    use DescriptionPart;
    use TypePart;
    use ItemsPart;
    use ExtensionPart;

    /** @var string */
    private $header;

    public function __construct($header, $contents = null)
    {
        $this->header = $header;
        $this->parse($contents === null ? new Map() : $contents);
    }

    private function parse($contents = [])
    {
        $data = CollectionUtils::toMap($contents);

        // parts
        $this->parseDescription($data);
        $this->parseType($data);
        $this->parseItems($data);
        $this->parseExtensions($data);
    }

    public function toArray()
    {
        return $this->export('description', $this->getTypeExportFields(), 'items');
    }

    /**
     * Returns the header.
     * 
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }
}
