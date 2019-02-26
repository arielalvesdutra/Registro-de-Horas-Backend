<?php

namespace App\Database\Factories\Connections;

use App\Database;
use PDO;

/**
 * Essa factory é reponsável por retornar a conexão do banco
 * de dados padrão da aplicação.
 *
 * Class DefaultDatabaseConnection
 * @package App\Database\Factories\Connections
 */
class DefaultDatabaseConnection implements DatabaseConnectionFactoryInterface
{
    /**
     * @return PDO
     */
    public static function connect() : PDO
    {
        $databaseServerConnection =  new Database\DatabaseServerConnection(
            '192.168.11.100',
            'root',
            'password',
            '3600',
            'time_recorder'
        );

        return $databaseServerConnection->getPdo();
    }
}