<?php

namespace App\Database\Factories\Tables;

use App\Database;
use App\Database\Enum\ColumnType\IntType;
use App\Database\Enum\ColumnType\TextType;
use App\Database\Enum\MySQLEngine\InnoDb;

class TimeRecordsTable implements TableFactoryInterface
{
    public static function create()
    {

        $database = new Database\Database(
            new Database\DatabaseServerConnection(
                '192.168.11.100',
                'root',
                'password',
                '3600',
                'time_recorder'
            )
        );

        $tableName = 'time_records';
        $table = new Database\Table($tableName);

        $table->addColumn((new Database\Column('id', new IntType()))
            ->setNotNull()
            ->setAutoIncrement()
            ->setSize(12)
        );
        $table->addColumn((new Database\Column('title', new TextType()))
            ->setNotNull()
            ->setSize(50)
        );
        $table->addColumn((new Database\Column('initDateTime', new TextType()))
            ->setSize(20)
        );
        $table->addColumn((new Database\Column('endDateTime', new TextType()))
            ->setSize(20)
        );
        $table->addColumn((new Database\Column('duration', new TextType()))
            ->setSize(15)
        );

        $table->addPrimaryKey($table->getColumns()['id']);
        $table->setEngine(new InnoDb());

        $database->createTableIfNotExists($table);
    }
}