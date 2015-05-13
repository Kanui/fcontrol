<?php

namespace FControl\Message;

class ConfirmResponse extends AbstractResponse
{
    public function __construct(\stdClass $soapResponse)
    {
        if (!isset($soapResponse->confirmarRetornoSubLojaResult)) {
            throw new \LogicException('Cannot find expected node on Soap Response');
        }
        $transaction = $soapResponse->confirmarRetornoSubLojaResult;
        $this->setSuccess($transaction);
        $this->setCodeAndMessage($transaction);
    }
}
