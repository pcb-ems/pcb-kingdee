<?php

namespace PcbEms\PcbKingdee\Forms;

use PcbEms\PcbKingdee\Concerns\MapsFieldData;
use PcbEms\PcbKingdee\Contracts\Form;

class EntitySaveForm implements Form
{
    use MapsFieldData;

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
        $fieldMappings = $this->model->getFieldMappings();

        $modelData = $this->mapFieldData($this->data, $fieldMappings);

        return ['Model' => $modelData];
    }
}
