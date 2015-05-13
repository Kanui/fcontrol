<?php

namespace FControl\Tests\Providers;

use FControl\Parameter\Payment;
use FControl\Parameter\PaymentMethod;

class CreditCardPayment extends Payment
{
    public function __construct($value = 100, Buyer $buyer = null)
    {

        $document = null;
        $phone = null;
        parent::__construct(
            new PaymentMethod(PaymentMethod::CREDITCARD_MASTERCARD),
            1,
            $value,
            143,
            new Payment\CreditCard(
                'VISA',
                '5555666677772135',
                new\DateTime('2016-02-01'),
                'TESTER PROVIDER',
                'salt',
                '123',
                $document,
                $phone
            )
        );
    }
}
