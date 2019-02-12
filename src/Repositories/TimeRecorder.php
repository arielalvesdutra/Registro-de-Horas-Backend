<?php

namespace App\Repositories;

use App\Factories;
use App\Models\TimeRecord;
use App\Services\TimeRecorderService;

/**
 * Class TimeRecorder
 * @package App\Repositories
 *
 * @property TimeRecorderService $service
 * @property TimeRecord $model
 */
class TimeRecorder extends Repository
{

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function addTimeRecord(array $parameters = [])
    {
        $this->service->validateAddTimeRecordParameters($parameters);

        $timeRecord = Factories\TimeRecord::create($parameters);

        $timeRecord->setDuration(
            $this->service->calculateTimeDuration($timeRecord)
        );

        $this->model->save($timeRecord);
    }


    /**
     * @param int $recordId
     *
     * @throws \Exception
     */
    public function deleteTimeRecord(int $recordId)
    {
        $this->service->validateIdField($recordId);

        $this->model->delete($recordId);
    }

    /**
     * @param array $parameters
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getTimeRecords($parameters = [])
    {

        $this->service->validateGetTimeRecordsParameters($parameters);

        $filters = $this->service->getFiltersQueryParameters($parameters);
        $ordination = $this->service->getOrderByQueryParameter($parameters);

        $this->model->setOrderBy($ordination);

        if ($filters) {
            foreach ($filters as $key => $filter) {
                $this->model->addFilter($key, $filter);
            }
        }

        return $this->model->find();
    }

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function updateTimeRecord($parameters = [])
    {
        $this->service->validateUpdateTimeRecordParameters($parameters);

        $timeRecord = Factories\TimeRecord::create($parameters);

        //TODO: validar se há modificação

        $timeRecord->setDuration(
            $this->service->calculateTimeDuration($timeRecord)
        );

        $this->model->update($timeRecord);
    }
}