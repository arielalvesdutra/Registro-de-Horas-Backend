<?php

namespace App\Models;

use App\Core\Database;

abstract class Model {

    protected $table;

    public static function all()
    {
        $object = new static();
        $pdo = Database::connect();
        //TODO: remover a ordenzação específica da Models\Model e colocar no Models\TimeRecord
        $query = $pdo->prepare("SELECT * FROM ". $object->table . " order by endDate desc");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function delete(int $id)
    {
        $object = new static();
        $pdo = Database::connect();

        $query = $pdo->prepare("DELETE FROM ". $object->table . " WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
    }
}