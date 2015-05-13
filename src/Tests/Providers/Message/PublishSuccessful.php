<?php

namespace FControl\Tests\Providers\Message;

class PublishSuccessful extends \stdClass implements SuccessfulInterface
{
    public $enfileirarTransacao9Result;
    public function __construct()
    {
        $this->enfileirarTransacao9Result = (object)array(
            'Sucesso' => true,
            'Mensagem' => '0|Transação enfileirada com sucesso'
        );
    }
}
