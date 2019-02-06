<?php

namespace App\Entities;

class TimeRecord extends Entity
{

    /**
     * @var string Título do registro
     */
    protected $title;

    /**
     * @var string Inicio do registro
     */
    protected $initTime;

    /**
     * @var string Final do registro
     */
    protected $endTime;

    /**
     * @var string Duração do registro
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

    public function setDuration(string $duration)
    {
        $this->duration = $duration;
        return $this;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }
}