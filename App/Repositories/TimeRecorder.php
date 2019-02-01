<?php

namespace App\Repositories;

use App\Factories;
use App\Models;
use App\Services\TimeRecorderService;
use App\Utils;

class TimeRecorder extends Repository
{

    public static function addTimeRecord($parameters = [])
    {

        $timeRecord = Factories\TimeRecord::create($parameters);

        $timeRecorderService = new TimeRecorderService();

        $timeRecord->setDuration(
            $timeRecorderService->calculateTimeDuration($timeRecord)
        );

        Models\TimeRecord::save($timeRecord);
    }

    public static function deleteTimeRecord(int $id)
    {
        Models\TimeRecord::delete($id);
    }

    public static function getTimeRecords()
    {
        $records = Models\TimeRecord::all();

        return $records;
    }

    public static function getTimeRecordsByFilters($filters = [])
    {
        // TODO: se não tiver nenhum filtro válido, gerá um exceção
        // TODO: validar os valores dos filtros
        // TODO: criar método para realizar as formatações necessárias para cada campo

        if($filters['initDate']) {
            $filters['initDate'] = TimeRecorderService::formatDate($filters['initDate']);
        }

        $records = Models\TimeRecord::getRecordsByFilters($filters);

        return $records;
    }

    public static function getTimeRecordsByInitDate(string $date)
    {
        // TODO: ->validarData

        $formattedDate = TimeRecorderService::formatDate($date);

        $records = Models\TimeRecord::getRecordsByInitDate($formattedDate);

        return $records;
    }

    public static function updateTimeRecord($parameters = [])
    {
        $timeRecord = Factories\TimeRecord::create($parameters);
        $timeRecorderService = new TimeRecorderService();

        //TODO: validar campos
        //TODO: validar se há modificação

        $timeRecord->setDuration(
            $timeRecorderService->calculateTimeDuration($timeRecord)
        );

        Models\TimeRecord::update($timeRecord);
    }
}