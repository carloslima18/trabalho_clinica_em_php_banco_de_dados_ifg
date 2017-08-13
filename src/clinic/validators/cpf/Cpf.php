<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 18/10/2016
 * Time: 23:03
 */
declare (strict_types=1);
namespace clinic\validators\cpf;
use clinic\errors\InvalidArgument;
class Cpf
{
    public $cpf;
    /**
     * Cpf constructor.
     * @param string $cpf
     * @throws InvalidArgument
     */
    public function __construct(string $cpf)
    {
        if($cpf ===''){
            throw new InvalidArgument('Digite o CPF');
        }
        if($this->countInt($cpf) == null){
            throw new InvalidArgument('CPF invalido');
        }
        $val = $this->countInt($cpf);
        if (!$this->validateCpf($cpf) OR $val == '00000000000' OR $val == "11111111111" OR  $val == '22222222222' OR $val == '33333333333'
            OR $val == '44444444444'OR $val == '555555555555'OR $val == '666666666666'OR $val == '77777777777'OR $val == '88888888888'OR $val == '99999999999') {
            throw new InvalidArgument('CPF invalido');
        }
        $this->cpf = $cpf;
    }
    public function countInt($cpf){
        $tmp1 = str_split($cpf);
        $i=0;
        $tmp2 = array();
        foreach($tmp1 as $char){
            if((ord($char) >= 48 AND ord($char) <= 57)){//pega somente numeros da string
                $tmp2[$i] = $char;
                $i++;
            }
        }
        if(count($tmp2) < 11){
            return null;
        }
        $tmp2 = implode('',$tmp2);
        return $tmp2;
    }

    /**
     * @return string $cpf formatted xxx.xxx.xxx-xx
     */
    public function getFormattedCpf():string
    {
        $cpf = $this->countInt($this->cpf);
        $cpf = str_split($cpf);
        $tmp[0] = $cpf[0];
        $tmp[1] = $cpf[1];
        $tmp[2] = $cpf[2];
        $tmp[3] = '.';
        $tmp[4] = $cpf[3];
        $tmp[5] = $cpf[4];
        $tmp[6] = $cpf[5];
        $tmp[7] = '.';
        $tmp[8] = $cpf[6];
        $tmp[9] = $cpf[7];
        $tmp[10] = $cpf[8];
        $tmp[11] = '-';
        $tmp[12] = $cpf[9];
        $tmp[13] = $cpf[10];
        $tmp = implode($tmp);
        return $tmp;
    }



    /**
     * @return string $cpf formatted xxx.xxx.xxx-xx
     */
    public function getFormattedCpf2():string
    {
        $cpf = $this->countInt($this->cpf);
        $cpf = str_split($cpf);
        $tmp[0] = $cpf[0];
        $tmp[1] = $cpf[1];
        $tmp[2] = $cpf[2];
        $tmp[3] = $cpf[3];
        $tmp[4] = $cpf[4];
        $tmp[5] = $cpf[5];
        $tmp[6] = $cpf[6];
        $tmp[7] = $cpf[7];
        $tmp[8] = $cpf[8];
        $tmp[9] = $cpf[9];
        $tmp[10] = $cpf[10];
        $tmp = implode($tmp);
        return $tmp;
    }

















    /**
     * @param string $cpf
     * @return bool 0 = $cpf invalid or 1 = $cpf valid
     */
    private function validateCpf(string $cpf):bool
    {
        $cpf = $this->countInt($cpf);
        $cpf = str_split($cpf);
        $sum1 = 0;
        $sum2 = 0;
        $i1 = 10;
        $i2 = 11;
        $j = 0;
        while ($i2 > 0) {
            $digit1 = (int)$cpf[$j];
            if ($i1 == 1) {
                $sum1 = $sum1 % 11;
                $sum1 = 11 - $sum1;
                if ($sum1 == 10 || $sum1 == 11) {
                    $sum1 = 0;
                }
                if ($sum1 != $digit1) {
                    return false;
                }
            }
            $sum1 = $sum1 + ($digit1 * $i1);
            $i1--;
            $digit2 = (int)$cpf[$j];
            if ($i2 == 1) {
                $sum2 = $sum2 % 11;
                $sum2 = 11 - $sum2;
                if ($sum2 == 10 || $sum2 == 11) {
                    $sum2 = 0;
                }
                if ($sum2 != $digit2) {
                    return false;
                }
            }
            $sum2 = $sum2 + ($digit2 * $i2);
            $i2--;
            $j++;
        }
        return true;
    }
}