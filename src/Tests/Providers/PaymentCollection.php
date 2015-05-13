<?php

namespace FControl\Tests\Providers;

class PaymentCollection extends \FControl\Parameter\PaymentCollection
{
    public static function createCreditCardPayment($value = 100, Buyer $buyer = null)
    {
        $collection = new static();
        $collection->append(new CreditCardPayment($value, $buyer));
        return $collection;
    }
}
