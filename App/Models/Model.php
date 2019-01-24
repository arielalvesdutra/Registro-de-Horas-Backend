<?php

namespace App\Models;

use App\Core\Database;

abstract class Model {

    protected $table;

    public static function all()
    {
        $object = new static();
        $pdo = Database::connect();

        $query = $pdo->prepare("SELECT * FROM ". $object->table);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}