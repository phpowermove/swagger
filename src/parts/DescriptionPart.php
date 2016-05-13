<?php

namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait DescriptionPart
{
    /** @var string */
    private $description = false;

    private function parseDescription(Map $data)
    {
        $this->description = $data->get('description');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
