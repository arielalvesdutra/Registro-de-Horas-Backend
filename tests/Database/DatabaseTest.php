<?php

namespace App\Database;

use App\Database\Enum\ColumnType\IntType;
use App\Database\Enum\ColumnType\TextType;
use App\Database\Enum\MySQLEngine\InnoDb;
use PDO;
use PHPUnit\Framework\TestCase;

/**
 * Testes unitários para a classe de conexão com o banco de dados.
 *
 * Class DatabaseTest
 * @package App\Database
 */
class DatabaseTest extends TestCase
{

    /**
     * @todo Pegar dados do arquivo .env
     *
     * Se conecta com o servidor de banco de dados, utiliza o comando para criar a base de dados
     * 'time_records_db_tests' e verifica se a base foi criada.
     *
     * @throws \Exception
     */
    public function assertPreConditions(): void
    {
        $databaseServerConnection = new DatabaseServerConnection(
            '192.168.11.100',
            'root',
            'password',
            3600
        );

        $databaseServerConnection->createDatabaseIfNotExists('time_recorder_db_tests');

        $this->assertTrue(
          $databaseServerConnection->hasDatabase('time_recorder_db_tests')
        );
    }

    /**
     * Testa a conexão com a base de dados.
     */
    public function testConnectionWithDatabaseShouldWork()
    {

        $database = new Database(
            $this->createNewDatabaseServerConnectionWithDatabase()
        );

        $this->assertInstanceOf(PDO::class, $database->getPdo());
        $this->assertInstanceOf(Database::class,
            $database);
    }

    /**
     * Testa a criação de uma tabela com o objeto Database.
     *
     * @throws \Exception
     */
    public function testCreateTableShouldWork()
    {
        $database = new Database(
            $this->createNewDatabaseServerConnectionWithDatabase()
        );

        $tableName = 'test_create_table';

        $table = new Table($tableName);

        $idColumn = (new Column('id', new IntType()))
            ->setSize(11)
            ->setAutoIncrement()
            ->setNotNull();
        $titleColumn = (new Column('title', new TextType()))
            ->setSize(35);

        $table->addColumn($idColumn);
        $table->addColumn($titleColumn);
        $table->addPrimaryKey($idColumn);
        $table->setEngine(new InnoDb());

        $database->createTable($table);

        $this->assertTrue($database->hasTable($tableName));
    }

    /**
     * Testa a criação de uma tabela, se ela não existir, com o objeto Database.
     *
     * @throws \Exception
     */
    public function testCreateTableIfNotExistsShouldWork()
    {
        $database = new Database(
            $this->createNewDatabaseServerConnectionWithDatabase()
        );

        $tableName = 'test_create_table_if_not_exists';

        $table = new Table($tableName);

        $idColumn = (new Column('id', new IntType()))
            ->setSize(11)
            ->setAutoIncrement()
            ->setNotNull();
        $titleColumn = (new Column('title', new TextType()))
            ->setSize(35);

        $table->addColumn($idColumn);
        $table->addColumn($titleColumn);
        $table->addPrimaryKey($idColumn);
        $table->setEngine(new InnoDb());

        $database->createTableIfNotExists($table);

        $this->assertTrue($database->hasTable($tableName));
    }

    /**
     * @todo Pegar dados do arquivo .env
     *
     * Retorna o objeto DatabaseServerConnection para o objeto Database.
     *
     * @return DatabaseServerConnection
     */
    private function createNewDatabaseServerConnectionWithDatabase() : DatabaseServerConnection
    {
        return new DatabaseServerConnection(
            '192.168.11.100',
            'root',
            'password',
            3600,
            'time_recorder_db_tests'
        );
    }
}