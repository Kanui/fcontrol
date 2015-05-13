<?php

namespace FControl\Exceptions;

class EnumeratorDataNotFound extends \InvalidArgumentException
{
    public function __construct($type, $input)
    {
        parent::__construct(sprintf('The input value (%s) was not found in %s.', $input, $type));
    }
}
