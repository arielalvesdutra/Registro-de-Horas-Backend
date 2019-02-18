<?php

namespace App\ValueObjects;

use Exception;

/**
 * Objeto de valor que representa a duração de um registro de tempo
 *
 * @example 14:10:10
 *
 * Class Duration
 * @package App\ValueObjects
 */
class Duration extends ValueObject
{
    const ONLY_NUMBER_REGULAR_EXPRESSION = '/^[0-9]*$/';

    /**
     * @example 14
     * @var string
     */
    protected $hours;

    /**
     * @example 10
     * @var string
     */
    protected $minutes;

    /**
     * @example 10
     * @var string
     */
    protected $seconds;

    public function __construct(string $hours, string $minutes, string $seconds)
    {
        $this->setHours($hours);
        $this->setMinutes($minutes);
        $this->setSeconds($seconds);
    }

    /**
     * @return string
     */
    public function getHours():string
    {
        return $this->hours;
    }

    /**
     * @return string
     */
    public function getMinutes():string
    {
        return $this->minutes;
    }

    /**
     * @return string
     */
    public function getSeconds():string
    {
        return $this->seconds;
    }

    /**
     * Esse método não pode se tornar público.
     *
     * @param string $hours
     *
     * @throws Exception
     */
    private function setHours(string $hours): void
    {
        if (!preg_match(self::ONLY_NUMBER_REGULAR_EXPRESSION, $hours)) {
            throw new Exception('Hours parameter is invalid.');
        }

        $this->hours = $hours;
    }

    /**
     * Esse método não pode se tornar público.
     *
     * @param string $minutes
     *
     * @throws Exception
     */
    private function setMinutes(string $minutes): void
    {
        if (strlen($minutes) != 2) {
            throw new Exception('Minutes parameter is invalid.');
        }

        if (!preg_match(self::ONLY_NUMBER_REGULAR_EXPRESSION, $minutes)) {
            throw new Exception('Minutes parameter is invalid.');
        }

        $this->minutes = $minutes;
    }

    /**
     * Esse método não pode se tornar público.
     *
     * @param string $seconds
     *
     * @throws Exception
     */
    private function setSeconds(string $seconds): void
    {
        if (strlen($seconds) != 2) {
            throw new Exception('Seconds parameter is invalid.');
        }

        if (!preg_match(self::ONLY_NUMBER_REGULAR_EXPRESSION, $seconds)) {
            throw new Exception('Seconds parameter is invalid.');
        }

        $this->seconds = $seconds;
    }

    /**
     * @return string 00:00:00
     */
    public function __toString()
    {
        return
            $this->getHours()   . ':' .
            $this->getMinutes() . ':' .
            $this->getSeconds();
    }
}
