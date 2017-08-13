<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 13/10/2016
 * Time: 08:34
 */
namespace clinic\errors;
class InvalidArgument extends \Exception
{
    static  public  function  className(){
        return 'InvalidArgument';
    }
}