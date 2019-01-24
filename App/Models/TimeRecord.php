<?php

namespace App\Models;

use App\Core\Database;
use App\Entities;

class TimeRecord extends Model {

    protected $table = "records";

    public static function save(Entities\TimeRecord $timeRecord)
    {
        $object = new Static();

        $pdo = Database::connect();

        $query = $pdo->prepare("INSERT INTO " . $object->table. " (title, initDate, endDate, duration)
                  VALUES (:title, :initDate, :endDate, :duration)");
        $query->bindParam(':title', $timeRecord->getTitle());
        $query->bindParam(':initDate', $timeRecord->getInitTime());
        $query->bindParam(':endDate', $timeRecord->getEndTime());
        $query->bindParam(':duration', $timeRecord->getDuration());

        $query->execute();
    }
}