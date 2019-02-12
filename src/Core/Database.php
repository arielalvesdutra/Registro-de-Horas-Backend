<?php

namespace App\Core;

/**
 * Classe responsável por se conectar com o banco de dados
 * e retornar um objeto \PDO
 *
 * Class Database
 * @package App\Core
 */
class Database
{
    /** @var string host de conexão com o banco*/
    private $host = "192.168.11.101";

    /** @var string base de dados de conexão com o banco */
    private $database = "registro-horas";

    /** @var string porta de conexão com o banco*/
    private $port = "3600";

    /** @var string usuário de conexão com o banco*/
    private $user = "root";

    /** @var string senha de conexão com o banco*/
    private $password = "exemplo";

    /**
     * @return \PDO
     */
    public static function connect()
    {
        $object = new static();

        try {

            $pdo = new \PDO(
                'mysql:host='.$object->host.';port='.$object->port.';dbname='.$object->database,
                $object->user,
                $object->password
            );
        } catch (\Exception $e) {
            die('<h2>Ocorreu um erro ao se conectar com o banco da dados!</h2>
                   <p> <b>ERRO</b>: <i>' . $e->getMessage() . '</i></p>');
        }

        return $pdo;
    }
}