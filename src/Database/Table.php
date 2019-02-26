<?php

namespace App\Database;

use App\Database\Enum\ColumnType\IntType;
use App\Database\Enum\MySQLEngine\MySQLEngine;
use Exception;


class Table
{
    protected $columns = [];

    protected $engine;

    protected $foreignKeys = [];

    protected $primaryKeys = [];

    protected $tableName;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function addColumn(Column $column)
    {
        $this->columns[$column->getName()] = $column;
    }

    public function addPrimaryKey(Column $column)
    {
        if (!$column->getType() instanceof IntType) {
            throw new Exception("A chave primária deve ser do tipo inteiro.");
        }

        $this->primaryKeys[] = $column;
    }

//    abstract public function delete();

    public function getColumns() : array
    {
        return $this->columns;
    }

    public function getColumnsDDL() : string
    {
        $columnsDDL = '';
        $numberOfColumns = sizeof($this->getColumns());
        $count = 1;

        foreach ($this->getColumns() as $column) {

            if ($numberOfColumns == $count) {
                $columnsDDL .= $column->__toString();
            } else {
                $columnsDDL .= $column->__toString() . ', ';
                $count++;
            }
        }

        return $columnsDDL;
    }

    public function getEngine(): MySQLEngine
    {
        return $this->engine;
    }

    private function getPrimaryKeys()
    {
        return $this->primaryKeys;
    }


    public function getPrimaryKey()
    {
        $numberOfColumns = sizeof($this->getPrimaryKeys());
        $count = 1;

        $primaryKeyDDL = 'PRIMARY KEY (';

        foreach ($this->getPrimaryKeys() as $key) {

            if ($numberOfColumns == $count) {
                $primaryKeyDDL .=  $key->getName();
            } else {
                $primaryKeyDDL .=  $key->getName() . ",";
                $count++;
            }
        }

        $primaryKeyDDL .= ")";

        return $primaryKeyDDL;
    }

    /**
     * @return string
     *
     * @throws Exception
     */
    public function getTableName()
    {
        if (empty($this->tableName)) {
            throw new Exception('O nome da tabela não foi configurado.');
        }

        return $this->tableName;
    }

//    abstract public function insert();

//    abstract public function select();

    public function setEngine(MySQLEngine $engine)
    {
        $this->engine = $engine;
    }

//    abstract public function update();
}


