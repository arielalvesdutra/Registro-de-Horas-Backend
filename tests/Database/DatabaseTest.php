<?php

namespace App\Database;

use App\Database\Enum\ColumnType\IntType;
use App\Database\Enum\ColumnType\TextType;
use App\Database\Enum\MySQLEngine\InnoDb;
use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

    /**
     * @todo Pegar dados do arquivo .env
     *
     * @throws \Exception
     */
    public function assertPostConditions(): void
    {
        $databaseServerConnection = new DatabaseServerConnection(
            '192.168.11.100',
            'root',
            'password',
            3600
        );

        $databaseServerConnection->createDatabaseIfNotExists('time_records_db_tests');

        $this->assertTrue(
          $databaseServerConnection->hasDatabase('time_records_db_tests')
        );
    }

    public function testConnectionWithDatabaseShouldWork()
    {

        $database = new Database(
            $this->createNewDatabaseServerConnectionWithDatabase()
        );

        $this->assertInstanceOf(PDO::class, $database->getPdo());
        $this->assertInstanceOf(Database::class,
            $database);
    }

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

    public function testDropTableShouldWork()
    {
        $database = new Database(
            $this->createNewDatabaseServerConnectionWithDatabase()
        );

        $tableName = 'test_drop_table';
        $table = new Table($tableName);

        $idColumn = (new Column('id', new IntType()))
            ->setSize(11)
            ->setAutoIncrement()
            ->setNotNull();

        $table->addColumn($idColumn);
        $table->addPrimaryKey($idColumn);
        $table->setEngine(new InnoDb());

        $database->createTable($table);
        $this->assertTrue($database->hasTable($tableName));

        $database->dropTable($tableName);
        $this->assertTrue($database->hasTable($tableName));
    }

    /**
     * @todo Pegar dados do arquivo .env
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
            'time_records_db_tests'
        );
    }
}