<?php

namespace App\Services;

use App\Factories;
use Exception;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * Testes Unitários do App\Services\TimeRecorderService
 *
 * Class TimeRecorderServiceTest
 * @package App\Services
 */
class TimeRecorderServiceTest extends TestCase
{

    /**
     * Testa o cálculo da duração de um registro de tempo com valores válidos.
     *
     * Método testado: calculateTimeDuration()
     *
     * @throws Exception
     */
    public function testCalculateTimeDurationWithValidDataShouldWork()
    {
        $service = new TimeRecorderService();
        $timeRecord = Factories\TimeRecord::create([
            'title' => 'Prática de PHP',
            'initDateTime' => '2019-01-01 10:00:00-0300',
            'endDateTime'  => '2019-01-01 12:00:00-0300'
        ]);

        $duration = $service->calculateTimeDuration($timeRecord);

        $this->assertEquals('2:00:00' , $duration->__toString());
    }

    /**
     * Testa o cálculo da duração de um registro de tempo com valores válidos
     * e timezone diferente entre o datetime inicial e o datetime final.
     *
     * Método testado: calculateTimeDuration()
     *
     * @throws Exception
     */
    public function testCalculateTimeDurationWithValidDataAndDistinctTimezoneShouldWork()
    {
        $service = new TimeRecorderService();
        $timeRecord = Factories\TimeRecord::create([
            'title' => 'Prática de PHP',
            'initDateTime' => '2019-01-01 10:00:00-0200',
            'endDateTime'  => '2019-01-01 12:00:00-0300'
        ]);

        $duration = $service->calculateTimeDuration($timeRecord);

        $this->assertEquals('3:00:00' , $duration->__toString());

        $timeRecord2 = Factories\TimeRecord::create([
            'title' => 'Prática de PHP',
            'initDateTime' => '2019-01-10 10:00:00-0200',
            'endDateTime'  => '2019-01-12 12:00:00+1100'
        ]);

        $duration2 = $service->calculateTimeDuration($timeRecord2);

        $this->assertEquals('37:00:00' , $duration2->__toString());
    }

    /**
     * Testa o cálculo da duração de tempo com valores inválidos, onde
     * o datetime inicial é maior que o datetime final e deve lançar um
     * throwable.
     *
     * Método testado: calculateTimeDuration()
     *
     * @throws Exception
     */
    public function testCalculateTimeDurationWithInvalidDataShouldThrowAnException()
    {
        $this->expectException(Throwable::class);

        $service = new TimeRecorderService();
        $timeRecord = Factories\TimeRecord::create([
            'title' => 'Prática de PHP',
            'initDateTime' => '2019-01-01 14:00:00-0300',
            'endDateTime'  => '2019-01-01 12:00:00-0300'
        ]);

        $service->calculateTimeDuration($timeRecord);
    }

    /**
     * Testa o cálculo da duração de tempo com parametro inválido e
     * deve gerar um throwable.
     *
     * Método testado: calculateTimeDuration()
     *
     * @throws Exception
     */
    public function testCalculateTimeDurationWithInvalidParameterShouldThrowAnException()
    {
        $this->expectException(Throwable::class);

        $service = new TimeRecorderService();
        $service->calculateTimeDuration('invalid data');
    }
}