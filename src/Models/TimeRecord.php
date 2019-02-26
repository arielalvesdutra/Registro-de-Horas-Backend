<?php

namespace App\Models;

use App\Entities;
use DateTime;

class TimeRecord extends Model
{

    /**
     * Nome da tabela
     *
     * @var string
     */
    protected $tableName = "time_records";

    /**
     * @param Entities\TimeRecord $timeRecord
     */
    public function save(Entities\IEntity $timeRecord)
    {

        $query = $this->getPdo()->prepare(
            "INSERT INTO " . $this->getTableName()
            . " (title, initDateTime, endDateTime, duration)
                  VALUES (:title, :initDate, :endDate, :duration)"
        );

        $query->bindParam(':title', $timeRecord->getTitle());
        $query->bindParam(':initDate', $timeRecord->getInitDateTime()->__toString());
        $query->bindParam(':endDate', $timeRecord->getEndDateTime()->__toString());
        $query->bindParam(':duration', $timeRecord->getDuration()->__toString());

        $query->execute();
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        if (empty($orderBy)) {
            $this->orderBy = 'initDateTime DESC';
        } else {
            $this->orderBy = $orderBy;
        }
    }

    /**
     * @param Entities\TimeRecord $timeRecord
     */
    public function update(Entities\IEntity $timeRecord)
    {

        $query = $this->getPdo()->prepare(
            "UPDATE " . $this->getTableName() .
            " SET title = :title, initDateTime = :initDate, endDateTime = :endDate, 
               duration = :duration, last_modified = :lastModified 
            WHERE id = :id"
        );

        $query->bindParam(':id', $timeRecord->getId());
        $query->bindParam(':title', $timeRecord->getTitle());
        $query->bindParam(':initDate', $timeRecord->getInitDateTime()->__toString());
        $query->bindParam(':endDate', $timeRecord->getEndDateTime()->__toString());
        $query->bindParam(':duration', $timeRecord->getDuration()->__toString());
        $query->bindParam(':lastModified', (new DateTime())->format('Y/m/d H:i:s'));

        $query->execute();
    }
}