<?php

namespace App\Services;

use App\Entities;

class TimeRecorderService extends Service
{

    /**
     * @param Entities\TimeRecord $timeRecord
     *
     * @return string
     *
     * @throws \Exception
     */
    public function calculateTimeDuration(Entities\TimeRecord $timeRecord): string
    {
        return $this->subtractDateTime($timeRecord->getInitTime(), $timeRecord->getEndTime());
    }

    /**
     * @param string $date
     *
     * @return string
     *
     * @throws \Exception
     */
    public static function formatDate(string $date): string
    {
        return date_format(new \DateTime($date), 'Y/m/d');
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    public function formatParameters(array $parameters): array
    {
        $formattedParameters = [];

        if ($parameters['title']) {
            $formattedParameters['filters']['title'] = " like '%". $parameters['title'].  "%'";
        }

        if ($parameters['initDate']) {
            $formattedParameters['filters']['initDate'] = ' = '. $parameters['initDate'];
        }

        if ($parameters['order']) {
            $desc = isset($parameters['desc'])
                ? ' desc'
                : '';

            $formattedParameters['order'] = $parameters['order'] . $desc;

        } else {
            $formattedParameters['order'] = 'initDate desc';
        }

        return $formattedParameters;
    }

    /**
     * @param array $parameters
     * @throws \Exception
     */
    public function validateTimeRecordParameters(array $parameters): void
    {

        if ($parameters['title'] && !$this->isValidTitle($parameters['title'])) {
            throw new \Exception('Título inválido!');
        }

        if ($parameters['initDate'] && !$this->isValidDate($parameters['initDate'])) {
            throw new \Exception('Data inicial inválida!');
        }

        if ($parameters['order'] && !$this->isValidOrder($parameters['order'])) {
            throw new \Exception('Campo de ordenação inválido!');
        }
    }

    /**
     * TODO: implementar
     *
     * @param string $date
     *
     * @return bool
     */
    private function isValidDate(string $date):bool
    {
        return true;
    }

    /**
     * @param string $order
     *
     * @return bool
     */
    private function isValidOrder(string $order):bool
    {
        if ($order === 'title') {
            return true;
        }

        if ($order === 'initDate') {
            return true;
        }

        if ($order === 'endDate') {
            return true;
        }

        return false;
    }

    /**
     * TODO: implementar
     *
     * @param string $title
     *
     * @return bool
     */
    private function isValidTitle(string $title):bool
    {
        return true;
    }

    /**
     * @param string $initDate
     * @param string $endDate
     *
     * @return string
     *
     * @throws \Exception
     */
    private function subtractDateTime(string $initDate, string $endDate): string
    {
        $date1 = new \DateTime($initDate);
        $date2 = new \DateTime($endDate);
        $dateDiff = $date2->diff($date1);

        $minutesSeconds = $dateDiff->format('%I:%S');
        $hours =  $this->getHoursFromDateInterval($dateDiff);

        $formattedDate = ("$hours:$minutesSeconds");

        return $formattedDate;
    }

    /**
     * @param \DateInterval $dateInterval
     *
     * @return float|int
     */
    private function getHoursFromDateInterval(\DateInterval $dateInterval)
    {
        $totalHours = $this->getHours($dateInterval) + $this->getHoursFromDays($dateInterval);

        return $totalHours;
    }

    /**
     * @param \DateInterval $dateInterval
     *
     * @return int
     */
    private function getHours(\DateInterval $dateInterval)
    {
        return $dateInterval->h;
    }

    /**
     * @param \DateInterval $dateInterval
     *
     * @return float|int
     */
    private function getHoursFromDays(\DateInterval $dateInterval)
    {
        return $dateInterval->days * 24;
    }
}

