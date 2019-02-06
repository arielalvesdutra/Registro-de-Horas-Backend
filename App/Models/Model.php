<?php

namespace App\Models;

use App\Core\Database;

abstract class Model implements IModel
{

    /**
     * @var Ordenação das consultas
     */
    protected $order;

    /**
     * @var array Filtros da consultas
     */
    protected $filters = [];

    /**
     * @var Nome da tabela
     */
    protected $tableName;

    /**
     * @var Objeto PDO para comunicação com o banco de dados
     */
    protected $pdo;

    public function __construct()
    {
        $this->setPdo(Database::connect());
    }

    /**
     * @param string $filter
     * @param string $filterValue
     */
    public function addFilter(string $filter, string $filterValue): void
    {
        $this->filters[$filter] = $filterValue;
    }

    /**
     * @return array
     */
    public function all()
    {
        $query = $this->getPdo()->prepare("SELECT * FROM " . $this->getTableName());
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->getPdo()->prepare("DELETE FROM ". $this->getTableName() . " WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
    }

    /**
     * @return array
     */
    public function find()
    {
        $query = $this->getPdo()->prepare($this->buildFindQuery());

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param \PDO $pdo
     */
    public function setPdo(\PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $order
     */
    public function setOrder(string $order):void
    {
        $this->order = $order;
    }

    /**
     * Constroi a query para o método find() com
     * os atributos $this->filters e $this->order
     *
     * @return string
     */
    private function buildFindQuery(): string
    {
        $query = 'SELECT * FROM ' . $this->getTableName();

        if ($this->getFilters()) {

            $query .= ' WHERE ';

            $firstFilter = true;

            foreach ($this->getFilters() as $key => $filter) {
                if ($firstFilter) {
                    $query .= ' ' . $key . $filter;
                    $firstFilter = false;
                }
                else {
                    $query .= ' AND '. $key  . $filter;
                }
            }
        }

        if ($this->getOrder()) {
            $query .= ' ORDER BY ' . $this->getOrder();
        }

        return $query;
    }
}