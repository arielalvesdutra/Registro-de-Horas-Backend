<?php

namespace App\Controllers;

use App\Repositories\Repository;

abstract class Controller
{
    protected $repository;

    protected function setRepository(Repository $repository)
    {
        $this->repository = $repository;
    }


}