<?php

namespace FControl\Tests\Providers\Message;

use FControl\Parameter\CaptureOrder;
use FControl\Parameter\CaptureOrderCollection;

class CaptureOrderCollectionSuccessful extends \stdClass implements SuccessfulInterface
{
    public $capturarResultadosTodasSubLojas4Result;

    public function __construct(CaptureOrderCollection $orderCollection)
    {
        $this->capturarResultadosTodasSubLojas4Result = (object)array(
            'WsAnaliseTodasSublojas3' => array(
                new CaptureSuccessful(new CaptureOrder(rand(100,149))),
                new CaptureSuccessful(new CaptureOrder(rand(150,199))),
            )
        );
    }
}
