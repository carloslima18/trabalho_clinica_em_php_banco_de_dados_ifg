<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 15/10/2016
 * Time: 17:41
 */

namespace test\date\dates;
use clinic\validators\date\dates\DateDMY;
use clinic\errors\InvalidArgument;

class DateDMYTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $date
     * @dataProvider providerTestConstruct
     */
    public function testConstruct($data,$regress){
        $test = new DateDMY($data);
        $this->assertEquals($test->dateDMY, $regress);
    }
    public function providerTestConstruct(){
        return [
            ['25012015','25/01/2015'],
            ['14102018','14/10/2018'],
            ['14-102-018','14/10/2018'],
            ['05,11.1777','05/11/1777'],
            ['05/111=777','05/11/1777'],
            ['29/03/2000','29/03/2000']
        ];
    }

    /**
     * @param $date
     * @dataProvider providerTestConstructInvalidDate
     * @expectedException clinic\errors\InvalidArgument
     */
    public function testConstructInvalidDate($date){
        $test = new DateDMY($date);
    }
    public function providerTestConstructInvalidDate(){
        return [
            ['01332001'],
            ['57028176198'],
            ['30326276198'],
            ['53121995'],
            ['12120000'],
            ['12132012'],
            ['31311111'],
            ['00000000'],
            ['000000000'],
            ['572343434'],
            ['30326276198'],

        ];
    }



    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestValidateDMY
     */
    public function testValidateDMY($date, $sentence){
        $test = new DateDMY($date);  //
        $this->assertEquals($test->validateDMY(), $sentence); // tinha date no parametro!!!
    }
    public function providerTestValidateDMY(){
        return[
            ['01012001',true],
            ['02042013',true],
            ['12/12/2012',true],
            ['22042002',true],
            ['12042010',true],
            ['02122051',true]
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetFormattedDate
     */
    public function testGetFormattedDate($date, $sentence){
        $test = new DateDMY($date);
        $this->assertEquals($test->getFormattedDate(),$sentence);
    }  // tava so getFormatted
    public function providerTestGetFormattedDate(){
        return [
            ['25022011','25/02/2011'],
            ['14122018','14/12/2018'],
            ['03111777','03/11/1777'],
            ['29032000','29/03/2000']
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetYear
     */
    public function testGetYear($date, $sentence){
        $test = new DateDMY($date);
        $this->assertEquals($test->getYear(),$sentence);
    }
    public function providerTestGetYear(){
        return [
            ['25022011','2011'],
            ['14122018','2018'],
            ['03111777','1777'],
            ['29032000','2000']
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetMonth
     */
    public function testGetMonth($date, $sentence){
        $test = new DateDMY($date);
        $this->assertEquals($test->getMonth(),$sentence);
    }
    public function providerTestGetMonth(){
        return [
            ['25022011','02'],
            ['14122018','12'],
            ['03111777','11'],
            ['29032000','03']
        ];
    }

    /**
     * @param $date
     * @param $sentence
     * @dataProvider providerTestGetDay
     */
    public function testGetDay($date, $sentence){
        $test = new DateDMY($date);
        $this->assertEquals($test->getDay(),$sentence);
    }
    public function providerTestGetDay(){
        return [
            ['25022011','25'],
            ['14122018','14'],
            ['03111777','03'],
            ['29032000','29']
        ];
    }
}
