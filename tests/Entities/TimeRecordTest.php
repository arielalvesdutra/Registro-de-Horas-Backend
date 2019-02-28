<?php

namespace App\Entities;

use App\Decorators\DateTimeDecorator;
use App\ValueObjects\Duration;
use PHPUnit\Framework\TestCase;

/**
 * Testes unitários da entidade TimeRecord.
 *
 * Class TimeRecordTest
 * @package App\Entities
 */
class TimeRecordTest extends TestCase
{

    const DATE_REGULAR_EXPRESSION = "/([0-9]{4})([\/])([0-9]{2})([\/])([0-9]{2})/";

    const TIME_REGULAR_EXPRESSION = "/^([0-9]{2})([:])([0-9]{2})([:])([0-9]{2})$/";

    const DATE_AND_TIME_REGULAR_EXPRESSION =
        '/^([0-9]{4})([-])([0-9]{2})([-])([0-9]{2}) ([0-9]{2})([:])([0-9]{2})([:])([0-9]{2}) ([A-Z]{3})([-,+]{0,1})([0-9]{4})*$/';

    public function assertPreConditions(): void
    {
        $this->assertTrue(
            class_exists('App\Entities\TimeRecord'),
            "Classe App\Entities\TimeRecord não encontrada."
        );
    }

    public function testSetTitleWithEmptyDataValueShouldThrowAnException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $emptyString = '';
        $timeRecord =  new TimeRecord();
        $timeRecord->setTitle($emptyString);
    }

    public function testGetTitleShouldWork()
    {
        $title = "Registro de Tempo";
        $timeRecord = new TimeRecord();
        $timeRecord->setTitle($title);
        $this->assertEquals($title, $timeRecord->getTitle());
    }

    public function testGetEndDateTimeShouldWork()
    {
        $endDateTime = new DateTimeDecorator("2019-01-01 10:00:00-0300");
        $timeRecord = new TimeRecord();
        $timeRecord->setEndDateTime($endDateTime);

        $this->assertEquals($endDateTime, $timeRecord->getEndDateTime());
        $this->assertRegExp(
            self::DATE_AND_TIME_REGULAR_EXPRESSION,
            $timeRecord->getEndDateTime()->__toString()
        );
    }

    public function testSetEndDateTimeShouldWork()
    {
        $entDateTime = new DateTimeDecorator("2019-01-01 10:00:00-0300");
        $timeRecord = new TimeRecord();
        $timeRecord->setEndDateTime($entDateTime);
    }

    public function testSetEndDateTimeWithInvalidDataShouldThrowAnException()
    {
        $this->expectException(\Throwable::class);
        $timeRecord = new TimeRecord();
        $timeRecord->setEndDateTime('Valor inválido.');
    }

    public function testEmptyGetEndDateTimeShouldThrowAnException()
    {
        $this->expectException(\Exception::class);
        $timeRecord = new TimeRecord();
        $timeRecord->getEndDateTime();
    }

    public function testGetInitDateTimeShouldWork()
    {
        $initDateTime = new DateTimeDecorator("2019-01-01 10:00:00-0300");
        $timeRecord = new TimeRecord();
        $timeRecord->setInitDateTime($initDateTime);

        $this->assertEquals($initDateTime, $timeRecord->getInitDateTime());
        $this->assertRegExp(
            self::DATE_AND_TIME_REGULAR_EXPRESSION,
            $timeRecord->getInitDateTime()->__toString()
        );
    }

    public function testSetInitDateTimeShouldWork()
    {
        $initDateTime = new DateTimeDecorator("2019-01-01 10:00:00-0300");
        $timeRecord = new TimeRecord();
        $timeRecord->setInitDateTime($initDateTime);
    }

    public function testSetInitDateTimeWithInvalidDataShouldThrowAnException()
    {
        $this->expectException(\Throwable::class);
        $timeRecord = new TimeRecord();
        $timeRecord->setInitDateTime('Valor inválido.');
    }

    public function testEmptyGetInitDateTimeShouldThrowAnException()
    {
        $this->expectException(\Exception::class);
        $timeRecord = new TimeRecord();
        $timeRecord->getInitDateTime();
    }

    public function testDurationGetterAndSetterShouldWork()
    {
        $hours = '14';
        $minutes = '25';
        $seconds = '10';

        $duration = new Duration($hours, $minutes, $seconds);
        $timeRecord = new TimeRecord();
        $timeRecord->setDuration($duration);
        $this->assertEquals($duration, $timeRecord->getDuration());
        $this->assertRegExp(
            self::TIME_REGULAR_EXPRESSION,
            $timeRecord->getDuration()->__toString()
        );
    }

    public function testGettersAndSettersShouldWork()
    {
        $id = 1;
        $title = "Registro de tempo";
        $initDateTime = new DateTimeDecorator("2019-01-01 10:00:00-0300");
        $endDateTime = new DateTimeDecorator("2019-01-01 10:00:00-0300");
        $duration = new Duration("2", "00", "00");

        $record = new TimeRecord(['id' => $id]);
        $record->setTitle($title)
                ->setInitDateTime($initDateTime)
                ->setEndDateTime($endDateTime)
                ->setDuration($duration);

        $this->assertEquals($id, $record->getId(), 'Erro no set ou get do id.');
        $this->assertEquals($title, $record->getTitle(), 'Erro no set ou get do título.');
        $this->assertEquals($initDateTime->__toString(), $record->getInitDateTime()->__toString(), 'Erro no set ou get da data inicial.');
        $this->assertEquals($endDateTime->__toString(), $record->getEndDateTime()->__toString(), 'Erro no set ou get da data final.');
        $this->assertEquals($duration->__toString(), $record->getDuration()->__toString(), 'Erro no set ou get da duração.');
    }
}