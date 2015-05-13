<?php

namespace FControl\Parameter;

class PaymentCollection extends \ArrayObject implements \JsonSerializable
{
    public function __construct(array $input = array(), $flags = 0, $iterator_class = "ArrayIterator")
    {
        if (is_array($input) && !empty($input)) {
            $this->checkInstanceOf(current($input));
        }
        parent::__construct($input, $flags, $iterator_class);
    }

    /**
     * Validate if given object is a instance of Payment class.
     * @param mixed $object Object to check instance.
     */
    private function checkInstanceOf($object)
    {
        if (!($object instanceof Payment)) {
            throw new \InvalidArgumentException('Product Collection only accept array with Product Objects');
        }
    }

    /**
     * @param int $index
     * @param Payment $newval
     */
    public function offsetSet($index, $newval)
    {
        $this->checkInstanceOf($newval);
        parent::offsetSet($index, $newval);
    }

    /**
     * @param Payment $value
     */
    public function append($value)
    {
        $this->checkInstanceOf($value);
        parent::append($value);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data without current index.
     */
    public function jsonSerialize()
    {
        return array('WsPagamento2' => array_values($this->getArrayCopy()));
    }
}
