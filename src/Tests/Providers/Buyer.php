<?php

namespace FControl\Tests\Providers;

use FControl\Parameter\Address;
use FControl\Parameter\ContactPhone;
use FControl\Parameter\Document;

class Buyer extends \FControl\Parameter\Buyer
{
    public function __construct()
    {
        $id = rand(1,100);
        parent::__construct(
            123,
            'Tester Provider '.$id,
            'test'.$id.'@provider.com',
            new \DateTime('2013-08-23'),
            new \DateTime(sprintf('- %s years',rand(18,  40))),
            new Address('BRA', rand('90000000', '99999999'), 'Test Street', 200, 'City', 'State', 'Neighborhood'),
            '29491430084',
            new ContactPhone(55, 41 . rand('900000000', '999999999')),
            new ContactPhone(55, 41 . rand('900000000', '999999999')),
            Buyer::GENDER_MALE,
            '129.45.133.54'
        );
        $this->Telefone2 = new ContactPhone(55, 41, rand('900000000', '999999999'));
        $this->Senha = 'qwerty';
    }
}
