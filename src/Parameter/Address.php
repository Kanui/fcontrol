<?php

namespace FControl\Parameter;

/**
 * Class Address
 * @package FControl\Parameter
 */
class Address extends AbstractParameter
{
    const WITHOUT_NUMBER = 'SEM NUMERO';
    protected $parameters = array(
        'Pais' => null,
        'Cep' => null,
        'Rua' => null,
        'Numero' => null,
        'Complemento' => null,
        'Bairro' => null,
        'Cidade' => null,
        'Estado' => null,
    );

    /**
     * @param $country
     * @param $zipCode
     * @param $street
     * @param $number
     * @param $city
     * @param $state
     * @param null $neighborhood
     * @param null $complement
     */
    public function __construct($country, $zipCode, $street, $number, $city, $state, $neighborhood = null, $complement = null)
    {
        $this->Pais = $country;
        $this->Cep = preg_replace('/[^\d]/', '', $zipCode);
        $this->Rua = $street;
        $this->Numero = $number;
        $this->Complemento = $complement;
        $this->Bairro = $neighborhood;
        $this->Cidade = $city;
        $this->Estado = $state;
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
        if (is_null($this->Numero)) {
            $data['Numero'] = static::WITHOUT_NUMBER;
        }
        return $data;
    }
}
