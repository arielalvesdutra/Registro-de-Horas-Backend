<?php

namespace App\Models;

use App\Core\Database;

abstract class Model implements IModel
{

    /**
     * Ordenação das consultas
     *
     * @var string
     */
    protected $orderBy;

    /**
     * Filtros da consultas
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Nome da tabela
     *
     * @var string
     */
    protected $tableName;

    /**
     * Objeto PDO para comunicação com o banco de dados
     *
     * @var \PDO
     */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->setPdo($pdo);
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
    public function find(): array
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
    public function getOrderBy(): string
    {
        return $this->orderBy;
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
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy):void
    {
        $this->orderBy = $orderBy;
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

        if ($this->getOrderBy()) {
            $query .= ' ORDER BY ' . $this->getOrderBy();
        }

        return $query;
    }
}