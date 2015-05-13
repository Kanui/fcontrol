<?php

namespace FControl\Parameter;

class ProductCollection extends \ArrayObject implements \JsonSerializable
{
    public function __construct(array $input = array(), $flags = 0, $iterator_class = "ArrayIterator")
    {
        if (is_array($input) && !empty($input)) {
            $this->checkInstanceOf(current($input));
        }
        parent::__construct($input, $flags, $iterator_class);
    }

    /**
     * Validate if given object is a instance of Product class.
     * @param mixed $object Object to check instance.
     */
    private function checkInstanceOf($object)
    {
        if (!($object instanceof Product)) {
            throw new \InvalidArgumentException('Product Collection only accept array with Product Objects');
        }
    }

    /**
     * @param int $index
     * @param Product $newval
     */
    public function offsetSet($index, $newval)
    {
        $this->checkInstanceOf($newval);
        if ($this->offsetExists($index)) {
            $product = $this->offsetGet($index);
            $newval->Quantidade += $product->Quantidade;
        }

        parent::offsetSet($index, $newval);
    }

    public function append($value)
    {
        $this->add($value);
    }

    public function add(Product $product)
    {
        $this->offsetSet($product->Codigo, $product);
    }

    public function countDifferentItems()
    {
        return parent::count();
    }

    public function count()
    {
        $quantity = 0;
        foreach ($this as $product) {
            $quantity += $product->Quantidade;
        }
        return $quantity;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data without current index.
     */
    public function jsonSerialize()
    {
        return array('WsProduto3' => array_values($this->getArrayCopy()));
    }
}
