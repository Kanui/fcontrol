<?php

namespace FControl\Parameter;


class Delivery extends AbstractParameter
{
    protected $parameters = array(
        'CpfCnpj' => null,
        'Sexo' => null,
        'DataNascimento' => null,
        'Email' => null,
        'Endereco' => null,
        'DddTelefone' => null,
        'NumeroTelefone' => null,
        'NomeEntrega' => null,
        'DddCelular' => null,
        'NumeroCelular' => null,
        'DddTelefone2' => null,
        'NumeroTelefone2' => null,
    );

    public function __construct(
        $name,
        $email,
        \DateTime $birthday,
        Address $address,
        $taxIdentification,
        ContactPhone $phone = null,
        ContactPhone $mobile = null,
        $gender = null
    )
    {
        $this->NomeEntrega = $name;
        $this->CpfCnpj = $taxIdentification;
        $this->Sexo = $gender;
        $this->DataNascimento = $birthday;
        $this->Email = $email;
        $this->Endereco = $address;
        $this->DddTelefone = $phone->getAreaCode();
        $this->NumeroTelefone = $phone->getNumber();
        $this->DddCelular = $mobile->getAreaCode();
        $this->NumeroCelular = $mobile->getNumber();
    }

    /**
     * @param ContactPhone $contactPhone
     * @return Delivery
     */
    public function setTelefone2(ContactPhone $contactPhone)
    {
        $this->Telefone2 = $contactPhone;
        return $this;
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
        if ($this->DataNascimento instanceof \DateTime) {
            $data['DataNascimento'] = $this->DataNascimento->format('Y-m-d');
        }
        return $data;
    }
}
