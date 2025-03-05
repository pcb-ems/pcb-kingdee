<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\SalesOrder;

class SalesOrderService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\SalesOrder
     */
    protected function newBillModel()
    {
        return new SalesOrder();
    }
}
