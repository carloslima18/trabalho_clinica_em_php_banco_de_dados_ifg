<?php
/**
 * Created by PhpStorm.
 * User: Genivaldo
 * Date: 17/02/2017
 * Time: 20:12
 */
declare (strict_types=1);
namespace clinic;
class Model{

    public $host;
    public $bd;
    public $usuario;
    public $password;
    public $link;
    public $porta;
    public $stringConect;
    public function __construct($host='localhost',$porta ='5432',$bd='testeclinica',$user='postgres',$pass='9343')
    {

        $this->host = $host;
        $this->bd=$bd;
        $this->usuario=$user;
        $this->password=$pass;
        $this->stringConect = "'$host','$porta','$bd','$user','$pass'";
    }

    //função que executa uma consulta na base de dados
    //podendo ser insert, update, select
    public function consultar(string $sql){
        $link = pg_connect("host=localhost port='5432' dbname='testeclinica' user='postgres' password='9343'");
        $this->link = $link;
        $query = pg_query($link,$sql) or die("error query." . pg_last_error());;
        if(!$query) {
            echo "erro de repeticao";
        }
        else {
            return $query;
        }
    }

    public function verificavazio($query){
        $t = pg_fetch_array($query,null,PGSQL_ASSOC);
        if($t == false){
            return true;
        }
        else{
            return false;
        }
    }

    public function retConect(){
        $link2 = pg_connect("host=localhost port='5432' dbname='testeclinica' user='postgres' password='9343'");
        return $link2;
    }

}