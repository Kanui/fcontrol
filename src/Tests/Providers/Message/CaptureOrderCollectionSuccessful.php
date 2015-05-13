<?php

namespace FControl\Tests\Providers\Message;

class CaptureOrderCollectionSuccessful extends \stdClass implements SuccessfulInterface
{
    public $capturarResultadosTodasSubLojas4Result;

    public function __construct()
    {
        $this->capturarResultadosTodasSubLojas4Result = (object)array(
            'WsAnaliseTodasSublojas3' => array(
                new CaptureSuccessful(),
                new CaptureSuccessful()
            )
        );
    }
}
