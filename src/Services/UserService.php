<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Models\User;

class UserService extends AbstractEntityService
{
    /**
     * @return \PcbEms\PcbKingdee\Models\User
     */
    protected function newModel()
    {
        return new User();
    }
}
