<?php

namespace App\Factories;

abstract  class Factory
{

    abstract static function create($parameters = []);
}