<?php

namespace FControl\Parameter\Payment;

use FControl\Parameter\AbstractParameter;
use FControl\Parameter\ContactPhone;
use FControl\Parameter\Document;

class CreditCard extends AbstractParameter
{
    const COUNTRY_BRAZIL = 55;
    protected $parameters = array(
        'NomeBancoEmissor' => null,
        'NumeroCartao' => null,
        'DataValidadeCartao' => null,
        'NomeTitularCartao' => null,
        'CpfTitularCartao' => null,
        'Bin' => null,
        'quatroUltimosDigitosCartao' => null,
        'BinBandeira' => null,
        'BinBanco' => null,
        'BinPais' => null,
        'DddTelefone2' => null,
        'NumeroTelefone2' => null,
    );

    public function __construct(
        $type,
        $number,
        \DateTime $expiresAt,
        $holderName,
        $salt,
        $authCode = null,
        $taxIdentification = null,
        ContactPhone $phone = null,
        $bank = null,
        $bankCode = null,
        $country = self::COUNTRY_BRAZIL
    )
    {
        $this->NomeBancoEmissor = $bank;
        $this->NumeroCartao = hash_hmac('SHA256', $number, $salt);
        $this->DataValidadeCartao = $expiresAt;
        $this->NomeTitularCartao = $holderName;
        $this->Bin = $authCode;
        $this->quatroUltimosDigitosCartao = substr($number, -4);
        $this->BinBandeira = $type;
        $this->BinBanco = $bankCode;
        $this->BinPais = $country;
        $this->CpfTitularCartao = $taxIdentification;
        if (!is_null($phone)) {
            $this->DddTelefone2 = $phone->getAreaCode();
            $this->NumeroTelefone2 = $phone->getNumber();
        }
    }

    public function jsonSerialize()
    {
        $data = $this->parameters;
        if ($this->DataValidadeCartao instanceof \DateTime) {
            $data['DataValidadeCartao'] = $this->DataValidadeCartao->format('m/Y');
        }
        return $data;
    }
}
