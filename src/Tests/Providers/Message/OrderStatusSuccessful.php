<?php

namespace FControl\Tests\Providers\Message;

class OrderStatusSuccessful extends \stdClass implements SuccessfulInterface
{
    public $alterarStatusSubLoja2Result;
    public function __construct()
    {
        $this->alterarStatusSubLoja2Result = (object)array(
            'Sucesso' => true,
            'Mensagem' => '0|Status alterado com sucesso.'
        );
    }
}
