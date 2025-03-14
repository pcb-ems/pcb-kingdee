<?php

namespace PcbEms\PcbKingdee\Forms;

use PcbEms\PcbKingdee\Contracts\Form;

class AuditForm implements Form
{
    /**
     * @var \PcbEms\PcbKingdee\Contracts\Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $data;

    /**
     * @param \PcbEms\PcbKingdee\Contracts\Model $model
     * @param array $data
     */
    public function __construct($model, $data)
    {
        $this->model = $model;

        $this->data = $data;
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
        return [
            'Ids' => implode(',', $this->data['ids'] ?? []),
            'Numbers' => $this->data['numbers'] ?? [],
        ];
    }
}
