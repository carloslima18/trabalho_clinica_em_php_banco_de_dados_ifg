<?php
/**
 * Created by PhpStorm.
 * User: Notebook
 * Date: 20/10/2016
 * Time: 19:26
 */
namespace test\person;
use clinic\person\Person;


class PersonTest extends \PHPUnit_Framework_TestCase{

    public function testConstruct(){
        $obj = new Person('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');

        $this->assertEquals($obj->getName(),'CARLOS'.' '.'EDUARDO');
        $this->assertEquals($obj->getRg(),'1212121');
        $this->assertEquals($obj->getAddress(),'/Rua: PALMEIRAS /Numero: 2023 /Complemento: COND P.R /Bairro: SAO JOAQUIM /Cidade: ANAPOLIS /Estado: GOIAS /CEP: 75000000');
        $this->assertEquals($obj->getDateBirth(),'05/12/1997');
        $this->assertEquals($obj->getCpf(),'703.281.761-09');
        $this->assertEquals($obj->getPhone(),'62993437996');
        $this->assertEquals($obj->getSex(),'MASC');
        $this->assertEquals($obj->getEmail(),'EMAIL@OUTLOOK.COM');
    }
}