<?php

namespace FControl\Tests\Providers;

class Product extends \FControl\Parameter\Product
{
    public function __construct($price = 50.00, $quantity = 1)
    {
        $id = rand(1, 9999);
        parent::__construct(
            'CXPL' . $id,
            'Product Test - ' . $id,
            $quantity,
            $price,
            'Decoracao'
        );
    }
}
