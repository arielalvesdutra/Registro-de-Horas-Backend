<?php

namespace App\Models;

use App\Entities\IEntity;

interface IModel
{

    /**
     * Adicionar um filtro na propriedade que contém um array
     * de filtros
     *
     * @param string $filter
     * @param string $filterValue
     */
    public function addFilter(string $filter, string $filterValue): void;

    /**
     * Retorna todos os registros
     *
     * @return mixed
     */
    public function all();

    /**
     * Remove o registro pelo $id no banco de dados
     *
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id);

    /**
     * Consulta registros no banco de dados
     *
     * Os filtros podem ser adicionados com o método addFilter()
     * A ordenação pode ser configurada com o método setOrderBy()
     *
     * @return mixed
     */
    public function find(): array;

    /**
     * Retorna um array com os filtros setados
     *
     * @return array
     */
    public function getFilters():  array;

    /**
     * Retorna a propriedade de ordenação para consultar no banco de dados
     *
     * @return string
     */
    public function getOrderBy(): string;

    /**
     * Retorna o objeto PDO para realizar operações com o banco de dados
     *
     * @return \PDO
     */
    public function getPdo(): \PDO;

    /**
     * Retorna o nome da tabela da model
     *
     * @return string
     */
    public function getTableName():string;

    /**
     * Recebe uma entidade como paramêtro e adiciona um registro no banco
     * com os dados da entidade
     *
     * @param IEntity $entity
     *
     * @return mixed
     */
    public function save(IEntity $entity);

    /**
     * Setar forma de ordenação para buscas na propriedade de
     * ordenação
     *
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void;


    /**
     * Setar o objeto PDO para a comunicação com o banco de dados
     *
     * @param \PDO $pdo
     */
    public function setPdo(\PDO $pdo): void;

    /**
     * Recebe uma entidade e atualiza o registro no banco com os
     * dados da entidade
     *
     * @param IEntity $entity
     *
     * @return mixed
     */
    public function update(IEntity $entity);
}