<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 15/10/2016
 * Time: 13:12
 */
declare (strict_types=1);
namespace clinic\validators\date;
use clinic\errors\InvalidArgument;
use Herrera\Json\Exception\Exception;

abstract class Date
{
    protected $date;
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * @return string in formatted xx/xx/xxxx
     */
    public function getFormattedDate():string
    {
        $date = strtolower($this->date);
        $tmp2 = array();
        $tmp1 = str_split($date);
        $i = 0;
        foreach($tmp1 as $char){
            if((ord($char) >= 48 AND ord($char) <= 57)){//pega somente numeros da string
                $tmp2[$i] = $char;
                $i++;
            }
        }
        if(count($tmp2) < 8){
            return "NULL";
        }

        $tmp1[0] = $tmp2[0];
        $tmp1[1] = $tmp2[1];
        $tmp1[2] = '/';
        $tmp1[3] = $tmp2[2];
        $tmp1[4] = $tmp2[3];
        $tmp1[5] = '/';
        $tmp1[6] = $tmp2[4];
        $tmp1[7] = $tmp2[5];
        $tmp1[8] = $tmp2[6];
        $tmp1[9] = $tmp2[7];
        $tmp1 = implode("", $tmp1);
        return $tmp1;
    }
    /**
     * @return string year xxxx
     */
    public function getYear():string
    {
        $tmp = $this->getFormattedDate();
        $tmp = str_split($tmp);
        $year[0] = $tmp[6];
        $year[1] = $tmp[7];
        $year[2] = $tmp[8];
        $year[3] = $tmp[9];
        $year = implode($year);
        return $year;
    }
}