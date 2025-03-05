<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\ReturnMtrl;

class ReturnMtrlService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\ReturnMtrl
     */
    protected function newBillModel()
    {
        return new ReturnMtrl();
    }
}
