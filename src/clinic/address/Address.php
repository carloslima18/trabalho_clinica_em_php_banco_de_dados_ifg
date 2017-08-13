<?php
/**
 * Created by PhpStorm.
 * User: genim
 * Date: 21/10/2016
 * Time: 17:49
 */
declare (strict_types=1);
namespace clinic\address;
class Address
{
    private $rua;
    private $numero;
    private $cidade;
    private $estado;
    private $bairro;
    private $complemento;
    private $cep;

    /**
     * Address constructor.
     * @param string $rua
     * @param string $numero
     * @param string $complemento
     * @param string $bairro
     * @param string $cidade
     * @param string $estado
     * @param string $cep
     */
    public function __construct(string $rua, string $numero, string $complemento, string $bairro, string $cidade,
                                string $estado, string $cep)
    {
        $this->rua = $rua;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
    }

    /**
     * @return string $address
     */
    public function getAddress():string
    {
        $address = '/Rua: ';
        $address .= $this->getRua();
        $address .= ' /Numero: ';
        $address .= $this->getNumero();
        $address .= ' /Complemento: ';
        $address .= $this->getComplemento();
        $address .= ' /Bairro: ';
        $address .= $this->getBairro();
        $address .= ' /Cidade: ';
        $address .= $this->getCidade();
        $address .= ' /Estado: ';
        $address .= $this->getEstado();
        $address .= ' /CEP: ';
        $address .= $this->getCep();
        return $address;
    }

    /**
     * @return string $Cep
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @return string $rua
     */
    public function getRua():string
    {
        return $this->rua;
    }

    /**
     * @return string $numero
     */
    public function getNumero():string
    {
        return $this->numero;
    }

    /**
     * @return string $complemento
     */
    public function getComplemento():string
    {
        return $this->complemento;
    }

    /**
     * @return string $bairro
     */
    public function getBairro():string
    {
        return $this->bairro;
    }

    /**
     * @return string $cidade
     */
    public function getCidade():string
    {
        return $this->cidade;
    }

    /**
     * @return string $estado
     */
    public function getEstado():string
    {
        return $this->estado;
    }

    /**
     * @param $rua
     */
    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    /**
     * @param $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @param $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @param $complemento
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     * @param $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @param $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @param $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}