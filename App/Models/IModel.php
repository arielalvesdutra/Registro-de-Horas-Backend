<?php

namespace App\Models;

use App\Entities\IEntity;

interface IModel
{

    public function addFilter(string $filter, string $filterValue): void;

    public function all();

    public function delete(int $id);

    public function find();

    public function getFilters():  array;

    public function getOrder(): string;

    public function getPdo(): \PDO;

    public function getTableName():string;

    public function save(IEntity $entity);

    public function setOrder(string $order): void;

    public function setPdo(\PDO $pdo): void;

    public function update(IEntity $entity);
}