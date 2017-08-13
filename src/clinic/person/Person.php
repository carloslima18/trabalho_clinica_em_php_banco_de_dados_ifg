<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 18/10/2016
 * Time: 12:17
 */
declare (strict_types=1);
namespace clinic\person;
use clinic\address\Address;
use clinic\validators\cpf\Cpf;
use clinic\validators\date\dates\DateDMY;
use clinic\Model;
class Person {
    protected $firstName;
    protected $lastName;
    protected $address;
    protected $dateBirth;
    protected $cpf;
    protected $rg;
    protected $phone;
    protected $sex;
    protected $email;
    public function __construct(string $firstName, string $lastName, string $rg, string $rua, string $numero, string $complemento,
                                string $bairro, string $cidade, string $estado, string $cep, string $date, string $cpf,
                                string $phone, string $sex, string $email){
        $this->firstName = strtoupper($firstName);
        $this->lastName = strtoupper($lastName);
        $this->address = new Address($rua, $numero, $complemento, $bairro, $cidade, $estado, $cep);

       // $this->dateBirth = new DateDMY($date);

        $this->cpf = new Cpf($cpf);

        $this->rg = $rg;
        $this->phone = $phone;
        $this->sex =strtoupper($sex);
        $this->email = $email;
    }

    /**
     * @return string $name
     */
    public function getName():string
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * @return string $rg
     */
    public function getRg():string
    {
        return $this->rg;
    }

    /**
     * @return string $address
     */
    public function getAddress():string
    {
        return $this->address->getAddress();
    }

    /**
     * @return string $dateBirth
     */
    public function getDateBirth(){
        return $this->dateBirth;
    }

    /**
     * @return string $cpf no formato xxx.xxx.xxx-xx
     */
    public function getCpf():string
    {
        return $this->cpf->getFormattedCpf();
    }

    /**
     * @return string $phone
     */
    public function getPhone():string
    {
        return $this->phone;
    }

    /**
     * @return string $sex
     */
    public function getSex():string
    {
        return $this->sex;
    }

    /**
     * @return string $email
     */
    public function getEmail():string
    {
        return $this->email;
    }

    /**
     * @param string $name
     */
    public function setName(string $name){
        $this->name = $name;
    }

    /**
     * @param string $rg
     */
    public function setRg(string $rg)
    {
        $this->rg = $rg;
    }

    /**
     * @param string $rua
     * @param string $numero
     * @param string $complemento
     * @param string $bairro
     * @param string $cidade
     * @param string $estado
     * @param string $cep
     */
    public function setAddress(string $rua, string $numero, string $complemento, string $bairro, string $cidade, string $estado, string $cep)
    {
        $this->address = new Address($rua, $numero, $complemento, $bairro, $cidade, $estado, $cep);
    }

    /**
     * @param string $dateBirth
     */
    public function setDateBirth(string $dateBirth)
    {
        $this->dateBirth = new DateDMY($dateBirth);
    }

    /**
     * @param string $cpf
     */
/*    public function setCpf(string $cpf)
    {
        $this->cpf = new Cpf($cpf);
    }*/

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param $sex
     */
    public function setSex(string $sex)
    {
        $this->sex = $sex;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public static function getIdAttribute()
    {
        return 'cpf';
    }
    public static function  getClassName()
    {
        return 'Person';
    }


}