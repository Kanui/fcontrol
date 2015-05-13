<?php

namespace FControl\Tests\Providers;

use FControl\Parameter\Status;

class Order extends \FControl\Parameter\Order
{
    public function __construct()
    {
        $products = ProductCollection::createRandomProducts(1);
        parent::__construct(
            rand(1,9999),
            new \DateTime('now'),
            $products->getGrandTotal(),
            new Buyer(),
            new Delivery(),
            PaymentCollection::createCreditCardPayment($products->getGrandTotal()),
            $products,
            new Status(Status::PENDING),
            true,
            Order::INTEGRATOR_CODE_UNKNOWN
        );
        $this->addExtraData(null);
        $this->addExtraData(null);
        $this->addExtraData(null);
        $this->addExtraData(null);
        $this->setSalesChannel('Internet');
        $this->setFreightTotal(0);
        $this->setDeliveryType('Sedex');
        $this->setDeliveryDate(new \DateTime('2013-08-29 00:00:00'));
    }
}
