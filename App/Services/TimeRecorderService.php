<?php

namespace App\Services;

use App\Entities;

class TimeRecorderService
{

    public function calculateTimeDuration(Entities\TimeRecord $timeRecord): string
    {
        return $this->subtractDateTime($timeRecord->getInitTime(), $timeRecord->getEndTime());
    }

    private function subtractDateTime(string $initDate, string $endDate)
    {
        $date1 = new \DateTime($initDate);
        $date2 = new \DateTime($endDate);
        $dateDiff = $date2->diff($date1);

        $minutesSeconds = $dateDiff->format('%I:%S');
        $hours =  $this->getHoursFromDateInterval($dateDiff);

        $formattedDate = ("$hours:$minutesSeconds");

        return $formattedDate;
    }

    private function getHoursFromDateInterval(\DateInterval $dateInterval)
    {
        $totalHours = $this->getHours($dateInterval) + $this->getHoursFromDays($dateInterval);

        return $totalHours;
    }

    private function getHours(\DateInterval $dateInterval)
    {
        return $dateInterval->h;
    }

    private function getHoursFromDays(\DateInterval $dateInterval)
    {
        return $dateInterval->days * 24;
    }


}

