<?php

namespace App\ValueObjects;

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Testes unitários do objeto de valor Duration.
 *
 * Class DurationTest
 * @package App\ValueObjects
 */
class DurationTest extends TestCase
{
    const TIME_REGULAR_EXPRESSION = "/^([0-9]{2,})([:])([0-9]{2})([:])([0-9]{2})$/";

    public function testSetDurationWithInvalidHoursDataShouldThrowAnException()
    {
        $this->expectException(Exception::class);

        $hours = 'invalid hours';
        $minutes = '25';
        $seconds = '10';

        new Duration($hours, $minutes, $seconds);

    }

    public function testSetDurationWithInvalidMinutesDataShouldThrowAnException()
    {
        $this->expectException(Exception::class);

        $hours = '14';
        $minutes = 'invalid minutes';
        $seconds = '10';

        new Duration($hours, $minutes, $seconds);
    }

    public function testSetDurationWithInvalidSecondsDataShouldThrowAnException()
    {
        $this->expectException(Exception::class);

        $hours = '14';
        $minutes = '25';
        $seconds = 'invalid seconds';

        new Duration($hours, $minutes, $seconds);
    }

    public function testToStringRegexShouldWork()
    {
        $hours = '14';
        $minutes = '25';
        $seconds = '10';

        $duration = new Duration($hours, $minutes, $seconds);
        $this->assertRegExp(
          self::TIME_REGULAR_EXPRESSION,
          $duration->__toString()
        );
    }
}
