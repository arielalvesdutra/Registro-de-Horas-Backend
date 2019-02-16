<?php

namespace App\Factories;

use PHPUnit\Framework\TestCase;

/**
 * Testes unitários da fábrica de TimeRecord.
 *
 * Class TimeRecordTest
 * @package App\Factories
 */
class TimeRecordTest extends TestCase
{
    public function assertPostConditions(): void
    {
        $this->assertTrue(
            class_exists('App\Factories\TimeRecord'),
            "Class App\Factories\TimeRecord not found."
        );
    }

    public function testInitDateTimeGreaterThanEndDateTimeShouldThrowException()
    {
        $this->expectException(\Exception::class);

        $parameters = [
            "title" => "Registro de tempo",
            "initDateTime" => "2019/01/01 12:00:00",
            "endDateTime" => "2019/01/01 10:00:00"
        ];

        TimeRecord::create($parameters);
    }

    /**
     * @throws \Exception
     */
    public function testShouldCreateATimeRecordEntityWithoutId()
    {
        $parameters = [
            "title" => "Registro de tempo",
            "initDateTime" => "2019/01/01 10:00:00",
            "endDateTime" =>  "2019/01/01 12:00:00"
        ];

        $timeRecord = TimeRecord::create($parameters);

        $this->assertInstanceOf('App\Entities\TimeRecord', $timeRecord, 'Returned object should be App\Entities\TimeRecord' );
    }

    /**
     * @throws \Exception
     */
    public function testShouldCreateATimeRecordEntityWithId()
    {
        $parameters = [
            "id" => 1,
            "title" => "Registro de tempo",
            "initDateTime" => "2019/01/01 10:00:00",
            "endDateTime" =>  "2019/01/01 12:00:00"
        ];

        $timeRecord = TimeRecord::create($parameters);

        $this->assertInstanceOf('App\Entities\TimeRecord', $timeRecord, 'Returned object should be App\Entities\TimeRecord' );
    }

    /**
     * @throws \Exception
     */
    public function testShouldCreateATimeRecordEntityWithIdAndDuration()
    {
        $parameters = [
            "id" => 1,
            "title" => "Registro de tempo",
            "initDateTime" => "2019/01/01 10:00:00",
            "endDateTime" =>  "2019/01/01 12:00:00",
            "duration" => [
                "hours" => '2',
                "minutes" => '15',
                "seconds" => '10'
            ]
        ];

        $timeRecord = TimeRecord::create($parameters);

        $this->assertInstanceOf('App\Entities\TimeRecord', $timeRecord, 'Returned object should be App\Entities\TimeRecord' );
    }

    /**
     * @throws \Exception
     */
    public function testWithoutInitDateTimeParameterShouldThrowException()
    {
        $this->expectException(\Exception::class);
        $parameters = [
            "title" => "Registro de tempo",
            "endDateTime" =>  "2019/01/01 12:00:00"
        ];

        TimeRecord::create($parameters);
    }

    /**
     * @throws \Exception
     */
    public function testWithoutEndDateTimeParameterShouldThrowException()
    {
        $this->expectException(\Exception::class);
        $parameters = [
            "title" => "Registro de tempo",
            "initDateTime" => "2019/01/01 10:00:00"
        ];

        TimeRecord::create($parameters);
    }

    /**
     * @throws \Exception
     */
    public function testWithoutTitleParameterShouldThrowException()
    {
        $this->expectException(\Exception::class);
        $parameters = [
            "initDateTime" => "2019/01/01 10:00:00",
            "endDateTime" =>  "2019/01/01 12:00:00"
        ];

        TimeRecord::create($parameters);
    }
}