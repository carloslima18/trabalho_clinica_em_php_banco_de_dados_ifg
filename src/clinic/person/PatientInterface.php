<?php
declare(strict_types=1);

namespace clinic\person;
interface PatientInterface {
    public function registerConsult(string $dentist, string $date, int $hour, int $minute);
    public function searchConsult(string $date):bool;
    public function getConsultDay(string $date);
    public function getAllConsults():array;
    public function deleteConsult(string $date):bool;
}