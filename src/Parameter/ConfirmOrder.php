<?php

namespace FControl\Parameter;

use FControl\Configuration;

class ConfirmOrder extends AbstractParameter
{
    protected $parameters = array(
        'login' => null,
        'senha' => null,
        'identificadorLojaFilho' => null,
        'codigoPedido' => null,
    );

    /**
     * @param $orderNumber
     */
    public function __construct($orderNumber)
    {
        $this->codigoPedido = $orderNumber;
    }

    /**
     * @param Configuration $configuration
     */
    public function setAuthentication(Configuration $configuration)
    {
        $this->login = $configuration->getLogin();
        $this->senha = $configuration->getPassword();
        $this->identificadorLojaFilho = $configuration->getStoreId();
    }
}
