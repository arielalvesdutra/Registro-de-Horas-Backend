<?php

namespace App\Models;

use App\Core\Database;
use App\Entities;

class TimeRecord extends Model
{

    protected $tableName = "time_records";

    public function save(Entities\IEntity $timeRecord)
    {

        $query = $this->getPdo()->prepare("INSERT INTO " . $this->getTableName() . " (title, initDate, endDate, duration)
                  VALUES (:title, :initDate, :endDate, :duration)");
        $query->bindParam(':title', $timeRecord->getTitle());
        $query->bindParam(':initDate', $timeRecord->getInitTime());
        $query->bindParam(':endDate', $timeRecord->getEndTime());
        $query->bindParam(':duration', $timeRecord->getDuration());

        $query->execute();
    }

    public function update(Entities\IEntity $entity)
    {
        $query = $this->getPdo()->prepare("UPDATE " . $this->getTableName() . " SET title = :title, initDate = :initDate, endDate = :endDate, duration = :duration WHERE id = :id");
        $query->bindParam(':id', $entity->getId());
        $query->bindParam(':title', $entity->getTitle());
        $query->bindParam(':initDate', $entity->getInitTime());
        $query->bindParam(':endDate', $entity->getEndTime());
        $query->bindParam(':duration', $entity->getDuration());

        $query->execute();
    }
}