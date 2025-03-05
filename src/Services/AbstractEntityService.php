<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Forms\AuditForm;
use PcbEms\PcbKingdee\Forms\DeleteForm;
use PcbEms\PcbKingdee\Forms\EntityCountForm;
use PcbEms\PcbKingdee\Forms\EntityFindForm;
use PcbEms\PcbKingdee\Forms\EntityPaginateForm;
use PcbEms\PcbKingdee\Forms\EntitySearchForm;
use PcbEms\PcbKingdee\Forms\EntitySaveForm;
use PcbEms\PcbKingdee\Forms\SubmitForm;
use PcbEms\PcbKingdee\Forms\UnauditForm;
use PcbEms\PcbKingdee\Results\Entity;
use PcbEms\PcbKingdee\Results\EntityCollection;
use PcbEms\PcbKingdee\Results\EntityPaginator;
use PcbEms\PcbKingdee\Results\SuccessResult;

abstract class AbstractEntityService extends AbstractService
{
    /**
     * @return \PcbEms\PcbKingdee\Contracts\Model
     */
    abstract protected function newModel();

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\EntityCollection
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function get($criteria = null)
    {
        $model = $this->newModel();

        $form = new EntitySearchForm($model, $criteria);

        $results = $this->executeQuery($form);

        return new EntityCollection($model, $results);
    }

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\Entity
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function find($criteria = null)
    {
        $model = $this->newModel();

        $form = new EntityFindForm($model, $criteria);

        $results = $this->executeQuery($form);

        return new Entity($model, $results);
    }

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\EntityPaginator
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function paginate($criteria = null)
    {
        $model = $this->newModel();

        $total = $this->executeCount(new EntityCountForm($model, $criteria));

        $results = $total > 0 ? $this->executeQuery(new EntityPaginateForm($model, $criteria)) : [];

        return new EntityPaginator($model, $criteria, $total, $results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function draft($data)
    {
        $model = $this->newModel();

        $form = new EntitySaveForm($model, $data);

        $results = $this->executeDraft($form);

        return new SuccessResult($results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function save($data)
    {
        $model = $this->newModel();

        $form = new EntitySaveForm($model, $data);

        $results = $this->executeSave($form);

        return new SuccessResult($results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function submit($data)
    {
        $model = $this->newModel();

        $form = new SubmitForm($model, $data);

        $results = $this->executeSubmit($form);

        return new SuccessResult($results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function audit($data)
    {
        $model = $this->newModel();

        $form = new AuditForm($model, $data);

        $results = $this->executeAudit($form);

        return new SuccessResult($results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function unaudit($data)
    {
        $model = $this->newModel();

        $form = new UnauditForm($model, $data);

        $results = $this->executeUnaudit($form);

        return new SuccessResult($results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function delete($data)
    {
        $model = $this->newModel();

        $form = new DeleteForm($model, $data);

        $results = $this->executeDelete($form);

        return new SuccessResult($results);
    }
}
