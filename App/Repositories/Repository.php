<?php

namespace App\Repositories;

use App\Models\Model;
use App\Services\Service;

abstract class Repository
{

    /**
     * Dependência de uma model
     *
     * @var Model
     */
    protected $model;

    /**
     * Dependência de um service
     *
     * @var Service
     */
    protected $service;

    public function __construct(Model $model, Service $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}