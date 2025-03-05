<?php

namespace PcbEms\PcbKingdee\Services;

use PcbEms\PcbKingdee\Forms\AuditForm;
use PcbEms\PcbKingdee\Forms\BillCountForm;
use PcbEms\PcbKingdee\Forms\BillFindForm;
use PcbEms\PcbKingdee\Forms\BillPaginateForm;
use PcbEms\PcbKingdee\Forms\BillSearchForm;
use PcbEms\PcbKingdee\Forms\BillSaveForm;
use PcbEms\PcbKingdee\Forms\DeleteForm;
use PcbEms\PcbKingdee\Forms\EntryCountForm;
use PcbEms\PcbKingdee\Forms\EntryFindForm;
use PcbEms\PcbKingdee\Forms\EntryPaginateForm;
use PcbEms\PcbKingdee\Forms\EntrySearchForm;
use PcbEms\PcbKingdee\Forms\PushForm;
use PcbEms\PcbKingdee\Forms\SubmitForm;
use PcbEms\PcbKingdee\Forms\UnauditForm;
use PcbEms\PcbKingdee\Results\Bill;
use PcbEms\PcbKingdee\Results\BillCollection;
use PcbEms\PcbKingdee\Results\BillPaginator;
use PcbEms\PcbKingdee\Results\Entry;
use PcbEms\PcbKingdee\Results\EntryCollection;
use PcbEms\PcbKingdee\Results\EntryPaginator;
use PcbEms\PcbKingdee\Results\SuccessResult;

abstract class AbstractBillService extends AbstractService
{
    /**
     * @return \PcbEms\PcbKingdee\Contracts\BillModel
     */
    abstract protected function newBillModel();

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\BillCollection
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function get($criteria = null)
    {
        $model = $this->newBillModel();

        $form = new BillSearchForm($model, $criteria);

        $results = $this->executeQuery($form);

        return new BillCollection($model, $results);
    }

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\EntryCollection
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function getEntries($criteria = null)
    {
        $model = $this->newBillModel();

        $form = new EntrySearchForm($model, $criteria);

        $results = $this->executeQuery($form);

        return new EntryCollection($model, $results);
    }

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\Bill
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function find($criteria = null)
    {
        $model = $this->newBillModel();

        $form = new BillFindForm($model, $criteria);

        $results = $this->executeQuery($form);

        return new Bill($model, $results);
    }

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\Entry
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function findEntry($criteria = null)
    {
        $model = $this->newBillModel();

        $form = new EntryFindForm($model, $criteria);

        $results = $this->executeQuery($form);

        return new Entry($model, $results);
    }

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\BillPaginator
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function paginate($criteria = null)
    {
        $model = $this->newBillModel();

        $total = $this->executeCount(new BillCountForm($model, $criteria));

        $results = $total > 0 ? $this->executeQuery(new BillPaginateForm($model, $criteria)) : [];

        return new BillPaginator($model, $criteria, $total, $results);
    }

    /**
     * @param \PcbEms\PcbKingdee\Query\Criteria|null $criteria
     * @return \PcbEms\PcbKingdee\Results\EntryPaginator
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function paginateEntries($criteria = null)
    {
        $model = $this->newBillModel();

        $total = $this->executeCount(new EntryCountForm($model, $criteria));

        $results = $total > 0 ? $this->executeQuery(new EntryPaginateForm($model, $criteria)) : [];

        return new EntryPaginator($model, $criteria, $total, $results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function draft($data)
    {
        $model = $this->newBillModel();

        $form = new BillSaveForm($model, $data);

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
        $model = $this->newBillModel();

        $form = new BillSaveForm($model, $data);

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
        $model = $this->newBillModel();

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
        $model = $this->newBillModel();

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
        $model = $this->newBillModel();

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
        $model = $this->newBillModel();

        $form = new DeleteForm($model, $data);

        $results = $this->executeDelete($form);

        return new SuccessResult($results);
    }

    /**
     * @param array $data
     * @return \PcbEms\PcbKingdee\Results\SuccessResult
     * @throws \PcbEms\PcbKingdee\Exceptions\ApiException
     */
    public function push($data)
    {
        $model = $this->newBillModel();

        $form = new PushForm($model, $data);

        $results = $this->executePush($form);

        return new SuccessResult($results);
    }
}
