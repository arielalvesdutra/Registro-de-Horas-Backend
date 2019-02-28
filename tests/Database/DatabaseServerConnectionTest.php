<?php

namespace App\Database;

use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseServerConnectionTest extends TestCase
{
    /**
     * Testa se a conexão com o servidor de banco de dados funciona.
     */
    public function testConnectWithDatabaseServerShouldWork()
    {
      $databaseServerConnection = new DatabaseServerConnection(
          '192.168.11.102',
          'root',
          'password',
          3600
      );

      $this->assertInstanceOf(PDO::class, $databaseServerConnection->getPdo());
      $this->assertInstanceOf(DatabaseServerConnection::class,
          $databaseServerConnection);
    }

    /**
     * Testa se a criação de uma base de dados funciona.
     */
    public function testCreateDatabaseIfNotExistsShouldWork()
    {

        $databaseServerConnection = new DatabaseServerConnection(
            '192.168.11.102',
            'root',
            'password',
            3600
        );

        $databaseServerConnection->createDatabaseIfNotExists(
            "test_create_if_not_exists"
        );

        $this->assertTrue(
            $databaseServerConnection->hasDatabase("test_create_if_not_exists")
        );
    }

    /**
     * Testa se o método de excluir uma base de dados funciona.
     */
    public function testDropDatabaseShouldWork()
    {

        $databaseServerConnection = new DatabaseServerConnection(
            '192.168.11.102',
            'root',
            'password',
            3600
        );

        $databaseServerConnection->createDatabase("test_drop_database");
        $this->assertTrue(
            $databaseServerConnection->hasDatabase("test_drop_database")
        );

        $databaseServerConnection->dropDatabase("test_drop_database");
        $this->assertFalse(
            $databaseServerConnection->hasDatabase("test_drop_database")
        );
    }
}