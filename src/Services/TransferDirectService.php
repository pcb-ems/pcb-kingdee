<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\TransferDirect;

class TransferDirectService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\TransferDirect
     */
    protected function newBillModel()
    {
        return new TransferDirect();
    }
}
