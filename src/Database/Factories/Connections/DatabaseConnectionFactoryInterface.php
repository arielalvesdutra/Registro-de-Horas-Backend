<?php

namespace App\Database\Factories\Connections;


interface DatabaseConnectionFactoryInterface
{
    public static function connect();
}