<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 13/10/2016
 * Time: 07:46
 */
declare (strict_types=1);
namespace clinic\validators\date\dates;
use clinic\errors\InvalidArgument;
use clinic\validators\date\Date;
class DateMDY extends Date
{
    public $dateMDY;
    public function __construct(string $date)
    {
        parent::__construct($date);
        $this->dateMDY = $this->getFormattedDate();
        if($this->dateMDY === "NULL"){
            throw new InvalidArgument("Type the date");
        }
        if(!$this->validateMDY()){
            throw new InvalidArgument("Date invalid");
        }
    }
    public function validateMDY():bool
    {
        $date = $this->getFormattedDate();
        $date = str_split($date);
        $day[0] = $date[3];
        $day[1] = $date[4];
        $month[0] = $date[0];
        $month[1] = $date[1];
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
     * return month
     * @return string
     */
    public function getMonth(){
        $tmp = $this->getFormattedDate();
        $tmp = str_split($tmp);
        $mes[0] = $tmp[0];
        $mes[1] = $tmp[1];
        $mes = (int)implode($mes);
        return $mes;
    }
    /**
     * return day
     * @return string
     */
    public function getDay(){
        $tmp = $this->getFormattedDate();
        $tmp = str_split($tmp);
        $dia[0] = $tmp[3];
        $dia[1] = $tmp[4];
        $dia = (int)implode($dia);
        return $dia;
    }
}