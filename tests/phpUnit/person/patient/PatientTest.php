<?php

/**
 * Created by PhpStorm.
 * User: Notebook
 * Date: 23/10/2016
 * Time: 13:56
 */
namespace test\person\patient;
use clinic\person\patient\Patient;

class PatientTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct(){
        $obj = new Patient('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');

        $this->assertEquals($obj->getName(),'CARLOS'.' '.'EDUARDO');
        $this->assertEquals($obj->getRg(),'1212121');
        $this->assertEquals($obj->getAddress(),'/Rua: PALMEIRAS /Numero: 2023 /Complemento: COND P.R /Bairro: SAO JOAQUIM /Cidade: ANAPOLIS /Estado: GOIAS /CEP: 75000000');
        $this->assertEquals($obj->getDateBirth(),'05/12/1997');
        $this->assertEquals($obj->getCpf(),'703.281.761-09');
        $this->assertEquals($obj->getPhone(),'62993437996');
        $this->assertEquals($obj->getSex(),'MASC');
        $this->assertEquals($obj->getEmail(),'EMAIL@OUTLOOK.COM');
    }

    /**
     * @param $date
     * @param $regress
     * @dataProvider providertestSearchConsult
     */
    public function testSearchConsult($date,$regress){
        $obj = new Patient('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');
        $this->assertEquals($obj->searchConsult($date),$regress);
    }
    public function providertestSearchConsult(){
        return[
            ['05121997',false],
            ['12,12,2012',false],
            ['05/12/1997',false],
            ['12,12,2012',false],
        ];
    }


    /**
     * @param $date
     * @param $regress
     * @dataProvider providertestGetColsultDay
     */
    public function testGetColsultDay($date,$regress){
        $obj = new Patient('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');
        $this->assertEquals($obj->getConsultDay($date),$regress);
    }
    public function providertestGetColsultDay(){
        return[
           ['05121997',NULL],
           ['12,12,2012',false],
           ['05/12/1997',NULL],
           ['12,12,2012',false],
        ];
    }

    public function testGetAllConsults(){
        $obj = new Patient('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');
        $this->assertEquals($obj->getAllConsults(),array());
    }

    /**
     * @param $date
     * @param $regress
     * @dataProvider providertestGetDate
     */
    public function testGetDate($date,$regress){
        $obj = new Patient('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');
        $this->assertEquals($obj->getDate($date),$regress);
    }
    public function providertestGetDate(){
        return[
            ['05121997','05/12/1997'],
            ['12,12,2012','12/12/2012'],
            ['05/12/1997','05/12/1997'],
            ['12,12,2012','12/12/2012'],
        ];
    }

    public function testDeleteConsult(){
        $obj = new Patient('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');
        $this->assertEquals($obj->deleteConsult('05122012'),false);
    }

    public function testdeletePositionVector(){
        $vect = array("1","2","3");
        $vect2 = array("1","3");
        $obj = new Patient('CARLOS','EDUARDO','1212121','PALMEIRAS','2023','COND P.R','SAO JOAQUIM','ANAPOLIS','GOIAS','75000000','05/12/1997','70328176109','62993437996','MASC','EMAIL@OUTLOOK.COM');
        $this->assertEquals($obj->deletePositionVector(1,$vect),NULL);
    }

}
