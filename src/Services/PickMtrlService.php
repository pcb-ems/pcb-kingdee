<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\PickMtrl;

class PickMtrlService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\PickMtrl
     */
    protected function newBillModel()
    {
        return new PickMtrl();
    }
}
