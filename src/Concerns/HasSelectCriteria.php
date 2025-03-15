<?php

namespace PcbEms\PcbKingdee\Concerns;

trait HasSelectCriteria
{
    /**
     * @param array $columnMappings
     * @return string
     */
    public function getSelectString($columnMappings)
    {
        return implode(',', array_values($columnMappings));
    }
}
