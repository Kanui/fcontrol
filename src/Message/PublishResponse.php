<?php

namespace FControl\Message;

class PublishResponse extends AbstractResponse
{
    public function __construct(\stdClass $soapResponse)
    {
        if (!isset($soapResponse->enfileirarTransacao9Result)) {
            throw new \LogicException('Cannot find expected node on Soap Response');
        }
        $transaction = $soapResponse->enfileirarTransacao9Result;
        $this->setSuccess($transaction);
        $this->setCodeAndMessage($transaction);
    }
}
