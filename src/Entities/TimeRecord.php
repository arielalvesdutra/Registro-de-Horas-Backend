<?php

namespace App\Entities;

class TimeRecord extends Entity
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
     * @var string
     */
    protected $initTime;

    /**
     * Final do registro
     *
     * @var string
     */
    protected $endTime;

    /**
     * Duração do registro
     *
     * @var string
     */
    protected $duration;

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $initTime
     *
     * @return $this
     */
    public function setInitTime(string $initTime)
    {
        $this->initTime = $initTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getInitTime(): string
    {
        return $this->initTime;
    }

    /**
     * @param string $endTime
     *
     * @return $this
     */
    public function setEndTime(string $endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->endTime;
    }

    /**
     * @param string $duration
     *
     * @return $this
     */
    public function setDuration(string $duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }
}