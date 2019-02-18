<?php

namespace App\Services;

use App\Entities\TimeRecord;
use App\ValueObjects\Duration;

interface ITimeRecorderService
{

    /**
     * Calcula a duração de um registro pela diferença entre o registro final
     * e o registro inicial
     *
     * @param TimeRecord $timeRecord
     *
     * @return string
     */
    public function calculateTimeDuration(TimeRecord $timeRecord): Duration ;

    /**
     * Retorna um array com os filtros formatados recebidos em uma requisição
     * GET para se utilizar na Model
     *
     * @param array $parameters
     *
     * @return array
     */
    public function getFiltersQueryParameters(array $parameters): array;


    /**
     * Retorna a ordenação formatada, caso ele esteja setada em um requisição
     * GET, para que se utilize na Model
     *
     * @param array $parameters
     *
     * @return string
     */
    public function getOrderByQueryParameter(array $parameters): string;

    /**
     * @param string $date
     *
     * @return bool
     */
    public function isValidDate(string $date):bool;

    /**
     * @param string $orderBy
     *
     * @return bool
     */
    public function isValidOrderBy(string $orderBy):bool;

    /**
     * @param string $title
     *
     * @return bool
     */
    public function isValidTitle(string $title) :bool;

    /**
     * @param string $endDate
     *
     * @throws \Exception
     */
    public function validateEndDateTimeField(string $endDate);

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function validateGetTimeRecordsParameters(array $parameters);

    /**
     * @param int $id
     *
     * @throws \Exception
     */
    public function validateIdField(int $id);

    /**
     * @param string $initDate
     *
     * @throws \Exception
     */
    public function validateInitDateTimeField(string $initDate);

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function validateAddTimeRecordParameters(array $parameters);

    /**
     * @param string $title
     *
     * @throws \Exception
     */
    public function validateTitleField(string $title);

    /**
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function validateUpdateTimeRecordParameters(array $parameters);
}
