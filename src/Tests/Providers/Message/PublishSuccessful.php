<?php

namespace FControl\Tests\Providers\Message;

use FControl\Parameter\Order;

class PublishSuccessful extends \stdClass implements SuccessfulInterface
{
    public $enfileirarTransacao9Result;
    public function __construct(Order $order)
    {
        $this->enfileirarTransacao9Result = (object)array(
            'Sucesso' => true,
            'Mensagem' => '0|Transação enfileirada com sucesso'
        );
    }
}
