<?php

namespace PcbEms\PcbKingdee\Results;

use PcbEms\PcbKingdee\Concerns\MapsQueryResult;
use PcbEms\PcbKingdee\Contracts\Arrayable;

class BillCollection implements Arrayable
{
    use MapsQueryResult;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @param \PcbEms\PcbKingdee\Contracts\BillModel $model
     * @param array $results
     */
    public function __construct($model, $results)
    {
        if (!empty($results)) {
            $this->items = $this->mapQueryResults($model, $results);
        }
    }

    /**
     * @param \PcbEms\PcbKingdee\Contracts\BillModel $model
     * @param array $results
     * @return array
     */
    protected function mapQueryResults($model, $results)
    {
        $attributes = $model->getBillAttributes();

        return array_map(function ($result) use ($attributes) {
            return $this->mapQueryResult($result, $attributes);
        }, $results);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }
}
