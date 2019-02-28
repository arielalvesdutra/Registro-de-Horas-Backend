<?php

namespace App\Decorators;

use DateTime;

/**
 * Decorator de que formata a data no padrão da aplicação.
 *
 * Class DateTimeDecorator
 * @package App\Decorators
 */
class DateTimeDecorator extends DateTime
{
    public function __toString()
    {
        return $this->format("Y-m-d H:i:s T");
    }
}