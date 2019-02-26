<?php

namespace App\Database;

use App\Database\Enum\ColumnType\ColumnType;

class Column
{

    protected $autoIncrement = false;

    protected $name;

    protected $notNull = false;

    protected $size;

    protected $type;

    public function __construct(string $name, ColumnType $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function setAutoIncrement() : Column
    {
        $this->autoIncrement = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAutoIncrement(): bool
    {
        return $this->autoIncrement;
    }

    /**
     * @return bool
     */
    public function isNotNull(): bool
    {
        return $this->notNull;
    }

    function setSize(int $size) : Column
    {
        $this->size = $size;
        return $this;
    }

    public function setNotNull() : Column
    {
        $this->notNull = true;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ColumnType
     */
    public function getType(): ColumnType
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    public function __toString()
    {
        $size = $this->getSize()
            ?  "(" .$this->getSize(). ")"
            : '';

        $notNull = $this->isNotNull()
            ? " NOT NULL"
            : "";

        $autoIncrement = $this->isAutoIncrement()
            ? " AUTO_INCREMENT"
            : "";

        return $this->getName() . " " .
               $this->getType()->getType() .
               $size .
               $notNull .
               $autoIncrement
            ;
    }
}