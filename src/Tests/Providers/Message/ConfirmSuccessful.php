<?php

namespace FControl\Tests\Providers\Message;

use FControl\Parameter\ConfirmOrder;

class ConfirmSuccessful extends \stdClass implements SuccessfulInterface
{
    public $confirmarRetornoSubLojaResult;

    public function __construct(ConfirmOrder $order)
    {
        $this->confirmarRetornoSubLojaResult = (object)array(
            'Sucesso' => true,
            'Mensagem' => '0|Retorno confirmado com sucesso.'
        );
    }
}
