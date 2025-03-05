<?php

namespace PcbEms\PcbKingdee\Forms;

use PcbEms\PcbKingdee\Contracts\Form;
use PcbEms\PcbKingdee\Query\Criteria;

class EntryCountForm implements Form
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

        $entryIdName = $this->model->getEntryIdName();

        $this->criteria = Criteria::make($criteria)->addFilterGreater($entryIdName, 0);
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
            'FieldKeys' => 'COUNT(1)',
            'FilterString' => $this->criteria->getFilterString($columnMappings),
            'OrderString' => '',
            'StartRow' => 0,
            'Limit' => 0,
        ];
    }
}
