<?php

namespace FControl\Tests\Providers\Message;

class ConfirmSuccessful extends \stdClass implements SuccessfulInterface
{
    public $confirmarRetornoSubLojaResult;

    public function __construct()
    {
        $this->confirmarRetornoSubLojaResult = (object)array(
            'Sucesso' => true,
            'Mensagem' => '0|Retorno confirmado com sucesso.'
        );
    }
}
