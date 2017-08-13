<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 15/10/2016
 * Time: 17:41
 */

namespace tests\date\dates;
use clinic\validators\date\dates\DateMDY;


class DateMDYTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $date
     * @dataProvider providerTestConstruct
     */
    public function testConstruct($date,$sentence){
        $test = new DateMDY($date);
        $this->assertEquals($test->dateMDY, $sentence);
    }
    public function providerTestConstruct(){
        return [
            ['12032014','12/03/2014'],
            ['10/12/2018','10/12/2018'],
            ['03/11/1777','03/11/1777'],
            ['05032000','05/03/2000']
        ];
    }

    /**
     * @param $date
     * @dataProvider providerTestConstructInvalidDate
     * @expectedException clinic\errors\InvalidArgument
     */
    public function testConstructInvalidDate($date){
        $test = new DateMDY($date);
    }
    public function providerTestConstructInvalidDate(){
        return [
            ['35022011'],
            ['54122018'],
            ['03611777'],
            ['39032000']
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestValidateDMY
     */
    public function testValidateDMY($date, $sentence){
        $test = new DateMDY($date);
        $this->assertEquals($test->validateMDY(), $sentence);
    }
    public function providerTestValidateDMY(){
        return[
            ['10102015',true],
            ['12111999',true],
            ['04/12/1500',true],
            ['02042002',true],
            ['12042010',true],
            ['02122051',true]
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetFormatted
     */
    public function testGetFormatted($date, $sentence){
        $test = new DateMDY($date);
        $this->assertEquals($test->getFormattedDate(),$sentence);
    }
    public function providerTestGetFormatted(){
        return [
            ['05022011','05/02/2011'],
            ['12122018','12/12/2018'],
            ['03111777','03/11/1777'],
            ['02032000','02/03/2000']
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetYear
     */
    public function testGetYear($date, $sentence){
        $test = new DateMDY($date);
        $this->assertEquals($test->getYear(),$sentence);
    }
    public function providerTestGetYear(){
        return [
            ['05022011','2011'],
            ['04122018','2018'],
            ['03111777','1777'],
            ['12032000','2000']
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetMonth
     */
    public function testGetMonth($date, $sentence){
        $test = new DateMDY($date);
        $this->assertEquals($test->getMonth(),$sentence);
    }
    public function providerTestGetMonth(){
        return [
            ['05022011','05'],
            ['04122018','04'],
            ['03111777','03'],
            ['12032000','12']
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetDay
     */
    public function testGetDay($date, $sentence){
        $test = new DateMDY($date);
        $this->assertEquals($test->getDay(),$sentence);
    }
    public function providerTestGetDay(){
        return [
            ['05022011','02'],
            ['04122018','12'],
            ['03111777','11'],
            ['02032000','03']
        ];
    }
}
