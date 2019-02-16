<?php
namespace App\Entities;

use App\Decorators\DateTimeDecorator;
use App\ValueObjects\Duration;

/**
 * Interface ITimeRecord
 * @package App\Entities
 */
interface ITimeRecord
{
    public function getDuration() : Duration;

    public function getEndDateTime(): DateTimeDecorator;

    public function getInitDateTime(): DateTimeDecorator;

    public function getTitle(): string;

    public function setDuration(Duration $duration);

    public function setEndDateTime(DateTimeDecorator $endDateTime);

    public function setInitDateTime(DateTimeDecorator $initDateTime);

    public function setTitle(string $title);
}
