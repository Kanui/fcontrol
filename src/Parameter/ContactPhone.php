<?php

namespace FControl\Parameter;

/**
 * Class ContactPhone
 * @package FControl\Parameter
 */
class ContactPhone extends AbstractParameter
{
    protected $parameters = array(
        'Ddi' => null,
        'Ddd' => null,
        'Numero' => null,
    );

    /**
     * @param int $countryCode
     * @param int $areaCode
     * @param int $number
     */
    public function __construct($countryCode, $areaCode, $number = null)
    {
        $this->Ddi = $countryCode;

        list($areaCode, $number) = $this->splitAreaCodeAndNumber($areaCode . $number);

        $this->Ddd = $areaCode;
        $this->Numero = $number;
    }

    protected function splitAreaCodeAndNumber($fullPhoneNumber)
    {
        $fullPhoneNumber = preg_replace('/[^\d]/', '', $fullPhoneNumber);
        $areaCode = substr($fullPhoneNumber, 0, 2);
        $phoneNumber = substr($fullPhoneNumber, 2);
        return array($areaCode, $phoneNumber);
    }

    public function getAreaCode()
    {
        return $this->Ddd;
    }

    public function getNumber()
    {
        return $this->Numero;
    }
}
