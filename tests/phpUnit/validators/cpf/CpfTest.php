<?php
/**
 * Created by PhpStorm.
 * User: Notebook
 * Date: 20/10/2016
 * Time: 23:03
 */

namespace test\validators\cpf;
use clinic\validators\cpf\Cpf;
use clinic\errors\InvalidArgument;


class CpfTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testa o contrutor da classe cpf
     * @param $cpf
     * @param $regress
     * @dataProvider providerTestConstruct
     */
    public function testConstruct($cpf,$regress){
        $obj = new Cpf($cpf);
        $this->assertEquals($obj->cpf,$regress);
    }
    public function providerTestConstruct(){
        return[
            ['703.281.761-09','703.281.761-09'],
            ['703-281-761/09','703-281-761/09'],
            ['821.346.375-79','821.346.375-79'],
            ['70328176109','70328176109'],
            ['821.346375-79','821.346375-79'],
            ['34838229330','34838229330']

        ];
    }


    /**
     * @param $date
     * @dataProvider providerTestConstructInvalidCpf
     * @expectedException clinic\errors\InvalidArgument
     */
    public function testConstructInvalidCpf($cpf){
        $test = new Cpf($cpf);
    }
    public function providerTestConstructInvalidCpf(){
        return [
            ['70328176198'],
            ['57028176198'],
         //   ['00000000000'],
            ['5702817'],
            ['30276198'],
            ['57028176198'],
            ['57erfrrgrt'],
            ['31111111118'],
            ['3032627619'],
            [' '],
          //  ['11111111111']

        ];
    }


    /**
     * @param $cpf
     * @param $regress
     * @dataProvider providertestCountInt
     */
    public function testCountInt($cpf,$regress){
        $obj = new Cpf($cpf);
        $this->assertEquals($obj->countInt($cpf),$regress);
    }
    public function providertestCountInt(){
        return[
            ['446.261.172-10','44626117210'],
            ['712-222-956.44','71222295644'],
            ['54\91\313\27\09','54913132709'],
            ['72673,,,453601','72673453601'],
            ['72673,,,453601','72673453601'],
            ['72a673a45b36r01','72673453601'],
            ['72673453601','72673453601'],
        ];
    }



    /**
     * @param $cpf
     * @param $regress
     * @dataProvider providerTestGetFormattedCpf
     */
    public function testGetFormattedCpf($cpf,$regress){
        $obj = new Cpf($cpf);
        $this->assertEquals($obj->getFormattedCpf(),$regress);
    }
    public function providerTestGetFormattedCpf(){
        return[
            ['44626117210','446.261.172-10'],
            ['71222295644','712.222.956-44'],
            ['54913132709','549.131.327-09'],
            ['712\22\2956\44','712.222.956-44'],
            ['5a4.,f91.h31,3k,2u70s9','549.131.327-09'],
            ['71222295644','712.222.956-44'],
            ['54-91-313-27-09','549.131.327-09'],
            ['72673453601','726.734.536-01']
        ];
    }


    /*
     * @param $cpf
     * @param $regress
     * @dataProvider providerTestFormatted
     *
    public function testFormatted($cpf,$regress){
        $obj = new Cpf($cpf);
        $result = $this->invokeMethod($obj, 'formatted', [$cpf]);
        $this->assertEquals($result,$regress);
    }
    public function providerTestFormatted(){
        return[
            ['703.281.761-09','70328176109'],
            ['348.382.293-30','34838229330'],
            ['011.328.581-78','01132858178'],
            ['44-6.2?61/172.1-0','44626117210']
        ];
    }*/

	
    /**
     * @param $cpf
     * @param $regress
     * @dataProvider providerTestValidateCpf
     */
    public function testValidateCpf($cpf,$regress){
        $obj = new Cpf($cpf);
        $result = $this->invokeMethod($obj, 'validateCpf', [$cpf]);
        $this->assertEquals($result,$regress);
    }
    public function providerTestValidateCpf(){
        return[
            ['70328176109',true],
            ['72673453601',true],
            ['703.281.761-09',true],
            ['726-734?5-3601',true],
            ['7-26-7-34-53601',true],
            ['703.281.761-09',true],
            ['726aaaa734verg5hy3601',true],
            ['169.054.796.08',true]
        ];
    }

    public function invokeMethod($objeto, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($objeto));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($objeto, $parameters);
    }
}
