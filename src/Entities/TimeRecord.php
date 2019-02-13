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
    protected $initDate;

    /**
     * Final do registro
     *
     * @var string
     */
    protected $endDate;

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
     * @param string $initDate
     *
     * @return $this
     */
    public function setInitDate(string $initDate)
    {
        $this->initDate = $initDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getInitDate(): string
    {
        return $this->initDate;
    }

    /**
     * @param string $endDate
     *
     * @return $this
     */
    public function setEndDate(string $endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
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