<?php

require __DIR__ . '/vendor/autoload.php';


/**
 * Método de Depuração
 */
function printrx()
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