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
    public function addTimeRecord($parameters = [])
    {

        $this->service->validateTimeRecordParameters($parameters);

        $timeRecord = Factories\TimeRecord::create($parameters);

        $timeRecord->setDuration(
            $this->service->calculateTimeDuration($timeRecord)
        );

        $this->model->save($timeRecord);
    }

    /**
     * @param int $recordId
     */
    public function deleteTimeRecord(int $recordId)
    {
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

        $this->service->validateTimeRecordParameters($parameters);

        $formattedParameters = $this->service->formatTimeRecordParameters($parameters);

        $this->model->setOrderBy($formattedParameters['order']);

        if($formattedParameters['filters']) {
            foreach ($formattedParameters['filters'] as $key => $filter) {
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
        $timeRecord = Factories\TimeRecord::create($parameters);

        //TODO: validar campos
        //TODO: validar se há modificação

        $timeRecord->setDuration(
            $this->service->calculateTimeDuration($timeRecord)
        );

        $this->model->update($timeRecord);
    }
}