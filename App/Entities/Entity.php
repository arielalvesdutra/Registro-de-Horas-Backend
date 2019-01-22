<?php

namespace App\Entities;

class Entity
{
    private $id;

    protected function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }


}