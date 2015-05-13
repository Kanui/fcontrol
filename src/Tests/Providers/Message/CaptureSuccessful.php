<?php

namespace FControl\Tests\Providers\Message;

class CaptureSuccessful extends \stdClass implements SuccessfulInterface
{
    public $capturarResultadoEspecificoSubLoja3Result;

    public function __construct()
    {
        $this->capturarResultadoEspecificoSubLoja3Result = (object)array(
            'CodigoCompra' => rand(100,999),
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
