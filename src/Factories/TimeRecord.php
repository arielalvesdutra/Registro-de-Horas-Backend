<?php

namespace App\Factories;

use App\Entities;

class TimeRecord extends Factory
{

    public static function create($parameters = []): Entities\TimeRecord
    {
        $timeRecord = (new Entities\TimeRecord($parameters))
            ->setTitle($parameters['title'])
            ->setInitDate($parameters['initDate'])
            ->setEndDate($parameters['endDate']);

        if (isset($parameters['duration'])) {
            $timeRecord->setDuration($parameters['duration']);
        }

        return $timeRecord;
    }
}