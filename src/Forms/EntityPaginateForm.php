<?php

namespace PcbEms\PcbKingdee\Forms;

use PcbEms\PcbKingdee\Contracts\Form;
use PcbEms\PcbKingdee\Query\Criteria;

class EntityPaginateForm implements Form
{
    /**
     * @var \PcbEms\PcbKingdee\Contracts\Model
     */
    protected $model;

    /**
     * @var \PcbEms\PcbKingdee\Query\Criteria
     */
    protected $criteria;

    /**
     * @param \PcbEms\PcbKingdee\Contracts\Model $model
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     */
    public function __construct($model, $criteria)
    {
        $this->model = $model;

        $this->criteria = Criteria::make($criteria);
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return $this->model->getFormName();
    }

    /**
     * @return array
     */
    public function getFormData()
    {
        $formName = $this->model->getFormName();

        $columnMappings = $this->model->getColumnMappings();

        return [
            'FormId' => $formName,
            'FieldKeys' => $this->criteria->getSelectString($columnMappings),
            'FilterString' => $this->criteria->getFilterString($columnMappings),
            'OrderString' => $this->criteria->getSortString($columnMappings),
            'StartRow' => $this->criteria->getOffset(),
            'Limit' => $this->criteria->getPerPage(),
        ];
    }
}
