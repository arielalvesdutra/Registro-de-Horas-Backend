<?php

namespace App\Database\Factories\Databases;

use App\Database;

class TimeRecorderDatabase implements DatabaseFactoryInterface
{
    public static function create()
    {
        $databaseServerConnection =  new Database\DatabaseServerConnection(
            '192.168.11.100',
            'root',
            'password',
            '3600'
        );

        $databaseServerConnection->createDatabaseIfNotExists('time_recorder');
    }
}