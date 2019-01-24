<?php

namespace App\Entities;

class Entity
{
    private $id;

    public function __construct($parameters = [])
    {
        if ($parameters['id']) {
            $this->setId((int) $parameters['id']);
        }
    }

    protected function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }


}