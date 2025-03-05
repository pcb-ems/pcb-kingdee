<?php

namespace PcbEms\PcbKingdee\Forms;

use PcbEms\PcbKingdee\Contracts\Form;
use PcbEms\PcbKingdee\Query\Criteria;

class BillCountForm implements Form
{
    /**
     * @var \PcbEms\PcbKingdee\Contracts\BillModel
     */
    protected $model;

    /**
     * @var \PcbEms\PcbKingdee\Query\Criteria
     */
    protected $criteria;

    /**
     * @param \PcbEms\PcbKingdee\Contracts\BillModel $model
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     */
    public function __construct($model, $criteria)
    {
        $this->model = $model;

        $this->criteria = Criteria::make($criteria);

        if ($this->model->isIntId()) {
            $idName = $this->model->getIdName();

            $this->criteria->addFilterGreater($idName, 0);
        }
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

        $columnMappings = $this->model->getBillColumnMappings();

        return [
            'FormId' => $formName,
            'FieldKeys' => 'COUNT(1)',
            'FilterString' => $this->criteria->getFilterString($columnMappings),
            'OrderString' => '',
            'StartRow' => 0,
            'Limit' => 0,
        ];
    }
}
