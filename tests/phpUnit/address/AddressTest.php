<?php
/**
 * Created by PhpStorm.
 * User: Notebook
 * Date: 21/10/2016
 * Time: 21:10
 */

namespace tests\address;
use clinic\address\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct(){
        $obj = new Address('rua','numero','complemento','bairro','cidade','estado','75000000');
        $this->assertEquals($obj->getRua(),'rua');
        $this->assertEquals($obj->getNumero(),'numero');
        $this->assertEquals($obj->getComplemento(),'complemento');
        $this->assertEquals($obj->getBairro(),'bairro');
        $this->assertEquals($obj->getCidade(),'cidade');
        $this->assertEquals($obj->getEstado(),'estado');
        $this->assertEquals($obj->getCep(),'75000000');
    }
}