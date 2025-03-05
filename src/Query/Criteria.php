<?php

namespace PcbEms\PcbKingdee\Query;

use PcbEms\PcbKingdee\Concerns\HasCursorCriteria;
use PcbEms\PcbKingdee\Concerns\HasFilterCriteria;
use PcbEms\PcbKingdee\Concerns\HasPaginationCriteria;
use PcbEms\PcbKingdee\Concerns\HasSelectCriteria;
use PcbEms\PcbKingdee\Concerns\HasSortCriteria;

class Criteria
{
    use HasCursorCriteria;
    use HasFilterCriteria;
    use HasPaginationCriteria;
    use HasSelectCriteria;
    use HasSortCriteria;

    /**
     * @param static|null $criteria
     * @return static
     */
    public static function make($criteria = null)
    {
        if ($criteria instanceof static) {
            return $criteria;
        }

        return new static();
    }
}
