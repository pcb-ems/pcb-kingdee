<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\MfgOrder;

class MfgOrderService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\MfgOrder
     */
    protected function newBillModel()
    {
        return new MfgOrder();
    }
}
