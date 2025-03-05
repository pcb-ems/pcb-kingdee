<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\PPBom;

class PPBomService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\PPBom
     */
    protected function newBillModel()
    {
        return new PPBom();
    }
}
