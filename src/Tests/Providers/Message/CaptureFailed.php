<?php

namespace FControl\Tests\Providers\Message;

class CaptureFailed extends \SoapFault implements FailedInterface
{
    public function __construct($order)
    {
        parent::__construct('test', '1|Some error occurred.', null);
    }
}
