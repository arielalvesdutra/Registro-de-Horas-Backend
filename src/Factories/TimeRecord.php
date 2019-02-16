<?php

namespace App\Factories;

use App\Decorators\DateTimeDecorator;
use App\Entities;
use App\ValueObjects\Duration;
use Exception;

class TimeRecord extends Factory
{

    public static function create($parameters = []): Entities\TimeRecord
    {

        if (empty($parameters['title'])) {
            throw new Exception('Title parameters is empty.');
        }

        if (empty($parameters['initDateTime'])) {
            throw new Exception('InitDateTime parameters is empty.');
        }

        if (empty($parameters['endDateTime'])) {
            throw new Exception('EndDateTime parameters is empty.');
        }

        $timeRecord = (new Entities\TimeRecord($parameters))
            ->setTitle($parameters['title'])
            ->setInitDateTime(new DateTimeDecorator($parameters['initDateTime']))
            ->setEndDateTime(new DateTimeDecorator($parameters['endDateTime']));

        if ($timeRecord->getInitDateTime()->getTimestamp() >
            $timeRecord->getEndDateTime()->getTimestamp()
        ){
            throw new Exception('InitDateTime is greater than endDateTime.');
        }

        if (isset($parameters['duration'])) {
            $timeRecord->setDuration(
                new Duration(
                    $parameters['duration']['hours'],
                    $parameters['duration']['minutes'],
                    $parameters['duration']['seconds']
                )
            );
        }

        return $timeRecord;
    }
}