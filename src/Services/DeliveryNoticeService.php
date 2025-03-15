<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\DeliveryNotice;

class DeliveryNoticeService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\DeliveryNotice
     */
    protected function newBillModel()
    {
        return new DeliveryNotice();
    }
}
