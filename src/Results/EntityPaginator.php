<?php

namespace PcbEms\PcbKingdee\Results;

use PcbEms\PcbKingdee\Concerns\MapsQueryResult;
use PcbEms\PcbKingdee\Contracts\Arrayable;
use PcbEms\PcbKingdee\Contracts\Paginator;
use PcbEms\PcbKingdee\Query\Criteria;

class EntityPaginator extends AbstractPaginator implements Arrayable, Paginator
{
    use MapsQueryResult;

    /**
     * @param \PcbEms\PcbKingdee\Contracts\Model $model
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @param int $total
     * @param array $results
     */
    public function __construct($model, $criteria, $total, $results)
    {
        $criteria = Criteria::make($criteria);

        $this->perPage = $criteria->getPerPage();

        $this->page = $criteria->getPage();

        $this->total = (int) $total;

        $this->items = !empty($results) ? $this->mapQueryResults($model, $results) : [];
    }

    /**
     * @param \PcbEms\PcbKingdee\Contracts\Model $model
     * @param array $results
     * @return array
     */
    protected function mapQueryResults($model, $results)
    {
        $attributes = $model->getAttributes();

        return array_map(function ($result) use ($attributes) {
            return $this->mapQueryResult($result, $attributes);
        }, $results);
    }
}
