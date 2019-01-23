<?php

namespace App\Entities;

class TimeRecord extends Entity
{

    protected $title;

    protected $initTime;

    protected $endTime;

    protected $duration;

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setInitTime(string $initTime): void
    {
        $this->initTime = $initTime;
    }

    public function getInitTime(): string
    {
        return $this->initTime;
    }

    public function setEndTime(string $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function setDuration(string $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }
}