<?php

namespace FControl\Tests\Providers\Message;

use FControl\Parameter\Order;

class PublishFailed extends \stdClass implements SuccessfulInterface
{
    public $enfileirarTransacao9Result;
    public function __construct(Order $order)
    {
        $this->enfileirarTransacao9Result = (object)array(
            'Sucesso' => false,
            'Mensagem' => '12|Uma exceção ocorreu ao enfileirar a transação.'
        );
    }
}
