<?php

namespace FControl\Tests\Providers;

use FControl\Parameter\Address;
use FControl\Parameter\ContactPhone;
use FControl\Parameter\Document;

class Delivery extends \FControl\Parameter\Delivery
{
    public function __construct()
    {
        parent::__construct(
            'Tester Provider',
            'test@provider.com',
            new \DateTime('1988-04-03'),
            new Address('BRA', rand('90000000', '99999999'), 'Test Street', 200, 'City', 'State', 'Neighborhood'),
            '29491430084',
            new ContactPhone(55, 41, rand('900000000', '999999999')),
            new ContactPhone(55, 41, rand('900000000', '999999999')),
            Buyer::GENDER_MALE
        );
        $this->setTelefone2(new ContactPhone(55, 41, '30478965'));
    }
}
