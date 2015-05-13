<?php

namespace FControl\Tests\Providers;

class ProductCollection extends \FControl\Parameter\ProductCollection
{
    public static function createRandomProducts($numberOfProducts = 1)
    {
        $collection = new static();
        for ($i = $numberOfProducts; $i > 0; $i--) {
            $collection->add(new Product());
        }
        return $collection;
    }

    public function getGrandTotal()
    {
        $grandTotal = 0;
        /** @var Product $product */
        foreach ($this as $product) {
            $grandTotal += $product->getUnitPrice();
        }
        return $grandTotal;
    }
}
