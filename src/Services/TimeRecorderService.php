<?php

// TODO: aplicar princípio SRP e utilizar patterns para separar as responsabilidades

namespace App\Services;

use App\Entities;

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
     * @return string
     *
     * @throws \Exception
     */
    public function calculateTimeDuration(Entities\TimeRecord $timeRecord): string
    {
        return $this->subtractDateTime($timeRecord->getInitTime(), $timeRecord->getEndTime());
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
            $filters['initDate'] = " like '". $this->formatDate($parameters['initDate']). "%'";
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
            $this->validateDateExpression($date);

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
        $this->validateInitDateField($parameters['initDate']);
        $this->validateEndDateField($parameters['endDate']);
    }

    /**
     * @param string $endDate
     *
     * @throws \Exception
     */
    public function validateEndDateField(string $endDate)
    {
        $this->validateDateExpression($endDate);
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
    public function validateInitDateField(string $initDate)
    {
        $this->validateDateExpression($initDate);
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
        $this->validateInitDateField($parameters['initDate']);
        $this->validateEndDateField($parameters['endDate']);
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
     * @param string $initDate yyyy/mm/dd hh:ii:ss
     * @param string $endDate  yyyy/mm/dd hh:ii:ss
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
    private function validateDateExpression(string $date)
    {
        if (!preg_match(self::DATE_AND_HOUR_REGULAR_EXPRESSION, $date)) {
            throw new \Exception('Formato de data inválido!');
        }
    }
}

