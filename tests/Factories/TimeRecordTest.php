<?php

namespace App\Factories;

use PHPUnit\Framework\TestCase;

class TimeRecordTest extends TestCase
{
    public function assertPostConditions(): void
    {
        $this->assertTrue(
            class_exists('App\Factories\TimeRecord'),
            "Class App\Factories\TimeRecord not found."
        );
    }

    public function testShouldCreateATimeRecordEntityWithoutId()
    {
        $parameters = [
            "title" => "Registro de tempo",
            "initDate" => "2019/01/01 10:00:00",
            "endDate" =>  "2019/01/01 12:00:00"
        ];

        $timeRecord = TimeRecord::create($parameters);

        $this->assertInstanceOf('App\Entities\TimeRecord', $timeRecord, 'Returned object should be App\Entities\TimeRecord' );
    }

    public function testShouldCreateATimeRecordEntityWithId()
    {
        $parameters = [
            "id" => 1,
            "title" => "Registro de tempo",
            "initDate" => "2019/01/01 10:00:00",
            "endDate" =>  "2019/01/01 12:00:00"
        ];

        $timeRecord = TimeRecord::create($parameters);

        $this->assertInstanceOf('App\Entities\TimeRecord', $timeRecord, 'Returned object should be App\Entities\TimeRecord' );
    }

    public function testShouldCreateATimeRecordEntityWithIdAndDuration()
    {
        $parameters = [
            "id" => 1,
            "title" => "Registro de tempo",
            "initDate" => "2019/01/01 10:00:00",
            "endDate" =>  "2019/01/01 12:00:00",
            "duration" => "2:00:00"
        ];

        $timeRecord = TimeRecord::create($parameters);

        $this->assertInstanceOf('App\Entities\TimeRecord', $timeRecord, 'Returned object should be App\Entities\TimeRecord' );
    }
}