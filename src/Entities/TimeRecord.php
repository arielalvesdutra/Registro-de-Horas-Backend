<?php

namespace App\Entities;

use App\Decorators\DateTimeDecorator;
use App\ValueObjects\Duration;
use Exception;

class TimeRecord extends Entity implements ITimeRecord
{

    /**
     * Título do registro
     *
     * @var string
     */
    protected $title;

    /**
     * Inicio do registro
     *
     * @var DateTimeDecorator
     */
    protected $initDateTime;

    /**
     * Final do registro
     *
     * @var DateTimeDecorator
     */
    protected $endDateTime;

    /**
     * Duração do registro
     *
     * @var Duration
     */
    protected $duration;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return DateTimeDecorator
     * @throws Exception
     */
    public function getInitDateTime(): DateTimeDecorator
    {
        if (empty($this->initDateTime)) {
            throw new Exception('InitDateTime attribute is empty.');
        }

        return $this->initDateTime;
    }

    /**
     * @return DateTimeDecorator
     * @throws Exception
     */
    public function getEndDateTime(): DateTimeDecorator
    {
        if (empty($this->endDateTime)) {
            throw new Exception('EndDateTime attribute is empty.');
        }

        return $this->endDateTime;
    }

    /**
     * @return Duration
     */
    public function getDuration(): Duration
    {
        return $this->duration;
    }

    /**
     * @param Duration $duration
     *
     * @return $this
     */
    public function setDuration(Duration $duration) : TimeRecord
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @param DateTimeDecorator $endDateTime
     *
     * @return $this
     */
    public function setEndDateTime(DateTimeDecorator $endDateTime) : TimeRecord
    {
        $this->endDateTime = $endDateTime;
        return $this;
    }

    /**
     * @param DateTimeDecorator $initDateTime
     *
     * @return $this
     */
    public function setInitDateTime(DateTimeDecorator $initDateTime) : TimeRecord
    {
        $this->initDateTime = $initDateTime;
        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title) : TimeRecord
    {
        if(!empty($title)) {
            $this->title = $title;
            return $this;
        }

        throw new \InvalidArgumentException("Title is empty.");
    }
}