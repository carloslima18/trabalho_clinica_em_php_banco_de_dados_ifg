<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 15/10/2016
 * Time: 13:01
 */
declare (strict_types=1);
namespace clinic\validators\date\dates;
use clinic\errors\InvalidArgument;
use clinic\validators\date\Date;
class DateDMY extends Date
{
    public $dateDMY;
    public function __construct(string $date)
    {
        if($date == null){
            throw new InvalidArgument("Data não pode ficar em branco");
        }
        parent::__construct($date);
        $this->dateDMY = $this->getFormattedDate();
        if($this->dateDMY === "NULL"){
            throw new InvalidArgument("Digite a data corretamente");
        }
        if(!$this->validateDMY()){
            throw new InvalidArgument("Data não existe");
        }
    }

    /**
     * @return bool true para data valida e false para data invalida
     */
    public function validateDMY():bool
    {
        $date = $this->getFormattedDate();
        $date = str_split($date);
        $day[0] = $date[0];
        $day[1] = $date[1];
        $month[0] = $date[3];
        $month[1] = $date[4];
        $year[0] = $date[6];
        $year[1] = $date[7];
        $year[2] = $date[8];
        $year[3] = $date[9];

        if (checkdate((int)implode($month), (int)implode($day), (int)implode($year))) {
            return true;
        }
        return false;
    }
    /**
     * @return string $month
     */
    public function getMonth(){
        $tmp = $this->getFormattedDate();
        $tmp = str_split($tmp);
        $mes[0] = $tmp[3];
        $mes[1] = $tmp[4];
        $mes = (int)implode($mes);
        return $mes;
    }
    /**
     * @return string $day
     */
    public function getDay(){
        $tmp = $this->getFormattedDate();
        $tmp = str_split($tmp);
        $dia[0] = $tmp[0];
        $dia[1] = $tmp[1];
        $dia = (int)implode($dia);
        return $dia;
    }
}