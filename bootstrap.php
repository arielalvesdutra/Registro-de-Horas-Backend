<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * Método de Depuração
 */
function debug()
{
    $arguments = func_get_args();
    echo '<pre>';
    foreach($arguments as &$argument){
        if (is_object($argument) || is_array($argument)) {
            print_r($argument);
        } elseif (empty($argument) || is_resource($argument)) {
            var_dump($argument);
        } else {
            echo (string)$argument;
        }
    }
    echo '</pre>';
}

/**
 * Método de Depuração que encerra execução do código
 */
function debugx()
{
    $arguments = func_get_args();
    echo '<pre>';
    foreach($arguments as &$argument){
        if (is_object($argument) || is_array($argument)) {
            print_r($argument);
        } elseif (empty($argument) || is_resource($argument)) {
            var_dump($argument);
        } else {
            echo (string)$argument;
        }
    }
    echo '</pre>';
    die();
}

use App\Database\Factories\Databases\TimeRecorderDatabase;
use App\Database\Factories\Tables\TimeRecordsTable;

TimeRecorderDatabase::create();
TimeRecordsTable::create();