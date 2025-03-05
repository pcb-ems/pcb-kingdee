<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\MisDelivery;

class MisDeliveryService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\MisDelivery
     */
    protected function newBillModel()
    {
        return new MisDelivery();
    }
}
