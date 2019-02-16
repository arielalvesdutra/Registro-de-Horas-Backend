<?php
/**
 * Created by PhpStorm.
 * User: ariel-dutra
 * Date: 15/02/19
 * Time: 22:03
 */

namespace App\Decorators;

use DateTime;

/**
 * TODO: documentar
 *
 * Class DateTimeDecorator
 * @package App\Decorators
 */
class DateTimeDecorator extends DateTime
{
    public function __toString()
    {
        return $this->format("Y/m/d H:i:s");
    }
}