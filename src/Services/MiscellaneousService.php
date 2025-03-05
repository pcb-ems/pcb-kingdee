<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\Miscellaneous;

class MiscellaneousService extends AbstractBillService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\Miscellaneous
     */
    protected function newBillModel()
    {
        return new Miscellaneous();
    }
}
