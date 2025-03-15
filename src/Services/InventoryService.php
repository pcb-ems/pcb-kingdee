<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\Inventory;

class InventoryService extends AbstractEntityService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\Inventory
     */
    protected function newModel()
    {
        return new Inventory();
    }
}
