<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\Customer;

class CustomerService extends AbstractEntityService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\Customer
     */
    protected function newModel()
    {
        return new Customer();
    }
}
