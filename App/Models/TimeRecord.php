<?php

namespace App\Models;

use App\Core\Database;
use App\Entities;

class TimeRecord extends Model {

    protected $table = "records";

    public static function getRecordsByFilters($filters = [])
    {
        $object = new Static();

        $pdo = Database::connect();

        $queryFilters = self::getQueryFilters($filters);
        $bindValues = self::getBindValues($filters);

        $query = $pdo->prepare("SELECT * FROM " . $object->table. " WHERE " . $queryFilters . " order by endDate desc");

        foreach ($bindValues as $key => $bindValue) {
            $parameter = ":$key";

            $query->bindValue($parameter, $bindValue);
        }

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    // TODO: remover este método
    public static function getRecordsByInitDate(string $date)
    {
        $object = new Static();

        $pdo = Database::connect();

        $query = $pdo->prepare("SELECT * FROM ". $object->table . " WHERE initDate like :initDate");
        $query->bindValue(':initDate', $date . "%" );
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

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

    public static function update(Entities\TimeRecord $timeRecord)
    {
        $object = new Static();

        $pdo = Database::connect();

        $query = $pdo->prepare("UPDATE " . $object->table . " SET title = :title, initDate = :initDate, endDate = :endDate, duration = :duration WHERE id = :id");
        $query->bindParam(':id', $timeRecord->getId());
        $query->bindParam(':title', $timeRecord->getTitle());
        $query->bindParam(':initDate', $timeRecord->getInitTime());
        $query->bindParam(':endDate', $timeRecord->getEndTime());
        $query->bindParam(':duration', $timeRecord->getDuration());

        $query->execute();
    }

    private function getBindValues($filters = [])
    {
        $bindValues = [];

        if ($filters['initDate']) {
            $bindValues['initDate'] = $filters['initDate'] . "%";
        }

        if ($filters['title']) {
            $bindValues['title'] = "%" . $filters['title'] ."%";

        }

        return $bindValues;
    }

    private function getQueryFilters($filters = []): string
    {
        $queryFilters = '';

        if ($filters['initDate']) {
            $queryFilters .= 'initDate like :initDate';
        }

        if ($filters['title']) {
            if ($queryFilters) {
                $queryFilters .= " AND title like :title";
            } else {
                $queryFilters .= " title like :title";
            }
        }

        return $queryFilters;
    }
}