<?php

//namespace App\Entities;

use App\Entities\TimeRecord;
use PHPUnit\Framework\TestCase;

class TimeRecordTest extends TestCase
{
    public function assertPreConditions(): void
    {
        $this->assertTrue(
            class_exists('App\Entities\TimeRecord'),
            "Classe App\Entities\TimeRecord não encontrada."
        );

    }

    public function testShouldGettersAndSettersWork()
    {
        $id = 1;
        $title = "Registro de tempo";
        $initDate = "2019/01/01 10:00:00";
        $endDate = "2019/01/01 12:00:00";
        $duration = "2:00:00";

        $record = new TimeRecord(['id' => $id]);
        $record->setTitle($title)
                ->setInitDate($initDate)
                ->setEndDate($endDate)
                ->setDuration($duration);

        $this->assertEquals($id, $record->getId(), 'Erro no set ou get do id.');
        $this->assertEquals($title, $record->getTitle(), 'Erro no set ou get do título.');
        $this->assertEquals($initDate, $record->getInitDate(), 'Erro no set ou get da data inicial.');
        $this->assertEquals($endDate, $record->getEndDate(), 'Erro no set ou get da data final.');
        $this->assertEquals($duration, $record->getDuration(), 'Erro no set ou get da duração.');
    }
}