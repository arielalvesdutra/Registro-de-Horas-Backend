<?php

namespace App\Entities;

class TimeRecord extends Entity
{

    protected $title;

    protected $initTime;

    protected $endTime;

    protected $duration;

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setInitTime(string $initTime)
    {
        $this->initTime = $initTime;
        return $this;
    }

    public function getInitTime(): string
    {
        return $this->initTime;
    }

    public function setEndTime(string $endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

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