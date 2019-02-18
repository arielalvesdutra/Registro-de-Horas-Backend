<?php

namespace App\Services;

use App\Decorators\DateTimeDecorator;
use App\Entities;
use App\ValueObjects\Duration;

/**
 * Class TimeRecorderService
 * @package App\Services
 */
class TimeRecorderService extends Service implements ITimeRecorderService
{
    const DATE_REGULAR_EXPRESSION = "/([0-9]{4})([-,\/])([0-9]{2})([-,\/])([0-9]{2})/";

    const HOUR_REGULAR_EXPRESSION = "/([0-9]{2})([:])([0-9]{2})([:])([0-9]{2})/";

    const DATE_AND_HOUR_REGULAR_EXPRESSION =
        '/([0-9]{4})([-,\/])([0-9]{2})([-,\/])([0-9]{2}) ([0-9]{2})([:])([0-9]{2})([:])([0-9]{2})/';

    /**
     * @param Entities\TimeRecord $timeRecord
     *
     * @return Duration
     *
     * @throws \Exception
     */
    public function calculateTimeDuration(Entities\TimeRecord $timeRecord): Duration
    {
        return $this->subtractDateTime($timeRecord->getInitDateTime(), $timeRecord->getEndDateTime());
    }

    /**
     * @param array $parameters
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getFiltersQueryParameters(array $parameters): array
    {
        $filters = [];

        if ($parameters['title']) {
            $filters['title'] = " like '%". $parameters['title'].  "%'";
        }

        if ($parameters['initDate']) {
            $filters['initDateTime'] = " like '". $this->formatDate($parameters['initDate']). "%'";
        }

        return $filters;
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    public function getOrderByQueryParameter(array $parameters): string
    {
        if (empty($parameters['order'])) {
            return '';
        }

        if($parameters['order'] == 'initDate') {
            return 'initDateTime';
        }

        return isset($parameters['desc'])
            ? $parameters['order'] . ' DESC'
            : $parameters['order'];
    }

    /**
     * Valida se o formato da data é válido
     *
     * @param string $date
     *
     * @return bool
     */
    public function isValidDate(string $date):bool
    {
        try {

            $this->validateDate($date);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param string $order
     *
     * @return bool
     */
    public function isValidOrderBy(string $order):bool
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
    public function isValidTitle(string $title):bool
    {
        return true;
    }

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function validateAddTimeRecordParameters(array $parameters): void
    {
        $this->validateTitleField($parameters['title']);
        $this->validateInitDateTimeField($parameters['initDateTime']);
        $this->validateEndDateTimeField($parameters['endDateTime']);
    }

    /**
     * @param string $endDate
     *
     * @throws \Exception
     */
    public function validateEndDateTimeField(string $endDate)
    {
        $this->validateDateTimeExpression($endDate);
        $this->validateDate($endDate);
    }

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function validateGetTimeRecordsParameters(array $parameters)
    {
        if ($parameters['title'] && !$this->isValidTitle($parameters['title'])) {
            throw new \Exception('Título inválido!');
        }

        if ($parameters['initDate'] && !$this->isValidDate($parameters['initDate'])) {
            throw new \Exception('Data inicial inválida!');
        }

        if ($parameters['endDate'] && !$this->isValidDate($parameters['endDate'])) {
            throw new \Exception('Data final inválida!');
        }

        if ($parameters['order'] && !$this->isValidOrderBy($parameters['order'])) {
            throw new \Exception('Campo de ordenação inválido!');
        }
    }

    /**
     * @param int $recordId
     *
     * @throws \Exception
     */
    public function validateIdField(int $recordId)
    {
        if (empty($recordId)) {
            throw new \Exception('O id está vazio!');
        }
    }

    /**
     * @param string $initDate
     *
     * @throws \Exception
     */
    public function validateInitDateTimeField(string $initDate)
    {
        $this->validateDateTimeExpression($initDate);
        $this->validateDate($initDate);
    }

    /**
     * @param string $title
     *
     * @throws \Exception
     */
    public function validateTitleField(string $title)
    {
        if (empty($title)) {
            throw new \Exception('O título está vazio!');
        }
    }

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function validateUpdateTimeRecordParameters(array $parameters)
    {
        $this->validateIdField($parameters['id']);
        $this->validateTitleField($parameters['title']);
        $this->validateInitDateTimeField($parameters['initDateTime']);
        $this->validateEndDateTimeField($parameters['endDateTime']);
    }

    /**
     * @param string $date
     *
     * @return string
     *
     * @throws \Exception
     */
    private function formatDate(string $date): string
    {
        return date_format(new \DateTime($date), 'Y/m/d');
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
    private function getHoursFromDateInterval(\DateInterval $dateInterval)
    {
        $totalHours = $this->getHours($dateInterval) + $this->getHoursFromDays($dateInterval);

        return $totalHours;
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

    /**
     * Subtrai a data/hora final pela data/hora inicial e retorna a
     * duração em horas da diferença entra elas
     *
     * @param DateTimeDecorator $initDate
     * @param DateTimeDecorator $endDate
     *
     * @return Duration
     *
     */
    private function subtractDateTime(DateTimeDecorator $initDate, DateTimeDecorator $endDate): Duration
    {

        $dateDifference = $endDate->diff($initDate);

        $minutes = $dateDifference->format('%I');
        $seconds = $dateDifference->format('%S');
        $hours =  $this->getHoursFromDateInterval($dateDifference);

        return new Duration(
            $hours,
            $minutes,
            $seconds
        );
    }

    /**
     * Gera uma exceção caso seja uma data inválida
     *
     * @param string $date
     *
     * @throws \Exception
     */
    private function validateDate(string $date)
    {
        new \DateTime($date);
    }

    /**
     * @param string $date
     *
     * @throws \Exception
     */
    private function validateDateTimeExpression(string $date)
    {
        if (!preg_match(self::DATE_AND_HOUR_REGULAR_EXPRESSION, $date)) {
            throw new \Exception('Formato de data inválido!');
        }
    }
}

