<?php
/**
 * Created by PhpStorm.
 * User: genim
 * Date: 21/10/2016
 * Time: 20:59
 */
declare (strict_types=1);
namespace clinic\person\patient;
use clinic\person\Person;
use clinic\validators\date\dates\DateDMY;
use clinic\errors\InvalidArgument;
use clinic\person\PatientInterface;
use clinic\person\PersistenceInterface;
use clinic\Model;

class Patient extends Person
{
    public $consults;

    public function __construct(string $firstName, string $lastName, string $rg, string $rua, string $numero, string $complemento,
                                string $bairro, string $cidade, string $estado, string $cep, string $date, string $cpf,
                                string $phone, string $sex, string $email)
    {
        parent::__construct($firstName, $lastName, $rg, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep,
            $date, $cpf, $phone, $sex, $email);
    }

    /**
     * registra nome do dentista, data no formato dd/mm/aaaa, hora e minutos.
     * @param string $dentist
     * @param string $date
     * @param int $hour
     * @param int $minute
     * @throws InvalidArgument
     */

    public function registerConsult(string $date, int $hour, int $minute){

        $bd = new Model();
        //pega as consultas de determinado dia
        $query = $bd->consultar("select * from Consulta as c where c.cdata = '$date' and c.hora = '$hour';");
        if(!pg_fetch_assoc($query)) {//se caso achar alguma data
            throw new InvalidArgument('Data já está marcada');
        }
        $consult = new DateDMY($date);
        $dataformatada = $consult->getFormattedDate();
        if($hour >= 24 OR $hour < 0){
            throw new InvalidArgument('Horario invalido');
        }
        if($minute >= 60 OR $minute < 0){
            throw new InvalidArgument('Minuto invalido');
        }
   }


    /**
     * @param string $date
     * @return bool true para consulta encontrada, false pra consulta não encontrada
     */
    public function searchConsult(string $date):bool{
        $date = $this->getDate($date);
        foreach($this->consultsDate as $position){
            if($date === $position){
                return true;
            }
        }
        return false;
    }

    /**
     * verifica a existencia da consulta, caso afirmativo, retorna os dados: dia e hora
     * @param string $date
     * @return mixed
     */
    public function getConsultDay(string $date)
    {
        if($date != NULL) {
            return $this->day = $date;
        }
        else{
            throw new InvalidArgument('getConsult invalida');
        }
    }

    public function getDay(){
        return $this->day;
    }

    /**
     * @return array com todas as consultas
     */
    public function getAllConsults():array{
        return $this->consults;
    }

    /**
     * @param string $date
     * @return string data no formato dd/mm/aaaa.
     */
    public function getDate(string $date):string{
        $date = new DateDMY($date);
        return $date->getFormattedDate();
    }


    /**
     * @return string nome da classe
     */
    public static function  getClassName()
    {
        return 'Patient';
    }

}
