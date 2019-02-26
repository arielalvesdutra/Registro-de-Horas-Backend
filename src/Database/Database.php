<?php

namespace App\Database;

use PDO;

class Database
{
    protected $databaseName;

    protected $pdo;

    public function __construct(DatabaseServerConnection $databaseServerConnection)
    {
        $this->pdo = $databaseServerConnection->getPdo();
    }

    public function createTable(Table $table)
    {
        $create = "CREATE TABLE " . $table->getTableName();

        $columns = "(" . $table->getColumnsDDL();
        $columns .= $table->getPrimaryKey()
            ? "," . $table->getPrimaryKey()
            : '';
        $columns .= ")";

        $engine = $table->getEngine()->getEngine()
            ?"engine=". $table->getEngine()->getEngine() . ";"
            : '';

        $ddl = $create . $columns . $engine;

        $this->getPdo()->exec($ddl);
    }

    public function createTableIfNotExists(Table $table)
    {
        $create = "CREATE TABLE IF NOT EXISTS " . $table->getTableName();

        $columns = "(" . $table->getColumnsDDL();
        $columns .= $table->getPrimaryKey()
            ? "," . $table->getPrimaryKey()
            : '';
        $columns .= ")";

        $engine = $table->getEngine()->getEngine()
            ?"engine=". $table->getEngine()->getEngine() . ";"
            : '';

        $ddl = $create . $columns . $engine;

        $this->getPdo()->exec($ddl);
    }

    public function dropTable(string $tableName)
    {
        $this->getPdo()->exec("DROP TABLE " . $tableName);
    }

    public function getDatabaseName() : string
    {
        return $this->databaseName;
    }

    public function getPdo() : PDO
    {
        return $this->pdo;
    }

    public function hasTable(string $tableName) : bool
    {
        if ($this->getPdo()->exec("SELECT * FROM " . $tableName . " LIMIT 1,1") === false) {
            return false;
        }

        return true;
    }
}
