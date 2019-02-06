<?php

namespace App\Entities;

abstract class Entity implements IEntity
{
    /**
     * @var int
     */
    private $id;

    public function __construct($parameters = [])
    {
        if ($parameters['id']) {
            $this->setId((int) $parameters['id']);
        }
    }

    /**
     * @param int $id
     */
    protected function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }


}