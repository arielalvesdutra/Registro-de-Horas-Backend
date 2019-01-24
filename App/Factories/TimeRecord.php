<?php

namespace App\Factories;

use App\Entities;

class TimeRecord extends Factory
{

    public static function create($parameters = [])
    {
        $timeRecord = (new Entities\TimeRecord())
            ->setTitle($parameters['title'])
            ->setInitTime($parameters['initDate'])
            ->setEndTime($parameters['endDate']);

        if ($parameters['duration']) {
            $timeRecord->setDuration($parameters['duration']);
        }

        return $timeRecord;
    }
}