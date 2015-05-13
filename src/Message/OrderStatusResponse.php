<?php

namespace FControl\Message;

class OrderStatusResponse extends AbstractResponse
{
    public function __construct(\stdClass $soapResponse)
    {
        if (!isset($soapResponse->alterarStatusSubLoja2Result)) {
            throw new \LogicException('Cannot find expected node on Soap Response');
        }
        $transaction = $soapResponse->alterarStatusSubLoja2Result;
        $this->setSuccess($transaction);
        $this->setCodeAndMessage($transaction);
    }
}
