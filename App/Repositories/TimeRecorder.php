<?php

namespace App\Repositories;

use App\Factories;
use App\Models;
use App\Services\TimeRecorderService;

class TimeRecorder extends Repository
{
    
    public static function addTimeRecord($parameters = [])
    {

        $timeRecord = Factories\TimeRecord::create($parameters);

        $timeRecorderService = new TimeRecorderService();

        $timeRecord->setDuration(
            $timeRecorderService->calculateTimeDuration($timeRecord)
        );

        Models\TimeRecord::save($timeRecord);
    }
}