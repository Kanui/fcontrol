<?php

namespace FControl\Parameter;


class Buyer extends AbstractParameter
{
    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';
    protected $parameters = array(
        'Codigo' => null,
        'DataCadastro' => null,
        'NomeComprador' => null,
        'Endereco' => null,
        'CpfCnpj' => null,
        'DddTelefone' => null,
        'NumeroTelefone' => null,
        'DddCelular' => null,
        'NumeroCelular' => null,
        'IP' => null,
        'Email' => null,
        'Senha' => null,
        'Sexo' => null,
        'DddTelefone2' => null,
        'NumeroTelefone2' => null,
        'DataNascimento' => null,
    );

    public function __construct(
        $id,
        $name,
        $email,
        \DateTime $registeredAt,
        \DateTime $birthday,
        Address $address,
        $taxIdentification,
        ContactPhone $phone = null,
        ContactPhone $mobile = null,
        $gender = null,
        $ipAddress = null
    )
    {
        $this->Codigo = $id;
        $this->NomeComprador = $name;
        $this->DataCadastro = $registeredAt;
        $this->DataNascimento = $birthday;
        $this->Email = $email;
        $this->Endereco = $address;
        $this->CpfCnpj = $taxIdentification;
        $this->DddTelefone = $phone->getAreaCode();
        $this->NumeroTelefone = $phone->getNumber();
        $this->DddCelular = $mobile->getAreaCode();
        $this->NumeroCelular = $mobile->getNumber();
        $this->Sexo = $gender;
        $this->IP = $ipAddress;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $data = $this->parameters;
        if ($this->DataCadastro instanceof \DateTime) {
            $data['DataCadastro'] = $this->DataCadastro->format('Y-m-d');
        }
        if ($this->DataNascimento instanceof \DateTime) {
            $data['DataNascimento'] = $this->DataNascimento->format('Y-m-d');
        }
        return $data;
    }
}
