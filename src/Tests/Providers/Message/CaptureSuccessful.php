<?php

namespace FControl\Tests\Providers\Message;

use FControl\Parameter\CaptureOrder;

class CaptureSuccessful extends \stdClass implements SuccessfulInterface
{
    public $capturarResultadoEspecificoSubLoja3Result;

    public function __construct(CaptureOrder $order)
    {
        $this->capturarResultadoEspecificoSubLoja3Result = (object)array(
            'CodigoCompra' => $order->getOrderNumber(),
            'Status' => 7,
            'CodigoMotivo' => 0,
            'Comentario' => '',
            'Analista' => '',
            'Email' => '',
            'Ramal' => '',
            'Telefone' => '',
            'OpiniaoFcontrol' => 0,
            'Score' => 350,
        );
    }
}
