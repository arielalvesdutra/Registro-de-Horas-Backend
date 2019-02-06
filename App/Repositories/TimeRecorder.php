<?php

namespace App\Repositories;

use App\Factories;

use App\Models\TimeRecord;

use App\Services\TimeRecorderService;

class TimeRecorder extends Repository
{

    public function __construct(TimeRecord $model, TimeRecorderService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }

    /**
     * @param array $parameters
     *
     * @return string
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
     * @return array|string
     */
    public function getTimeRecords($parameters = [])
    {
        try {

            $this->service->validateTimeRecordParameters($parameters);

            $formattedParameters = $this->service->formatParameters($parameters);

            $this->model->setOrder($formattedParameters['order']);

            if($formattedParameters['filters']) {
                foreach ($formattedParameters['filters'] as $key => $filter) {
                    $this->model->addFilter($key, $filter);
                }
            }

            return $this->model->find();

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param array $parameters
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