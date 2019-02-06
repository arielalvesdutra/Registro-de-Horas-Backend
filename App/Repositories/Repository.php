<?php

namespace App\Repositories;

use App\Models\Model;
use App\Services\Service;

abstract class Repository
{

    protected $model;

    protected $service;

    public function __construct(Model $model, Service $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}