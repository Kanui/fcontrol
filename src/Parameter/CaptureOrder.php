<?php

namespace FControl\Parameter;

use FControl\Configuration;

class CaptureOrder extends AbstractParameter
{
    protected $parameters = array(
        'login' => null,
        'senha' => null,
        'identificadorLojaFilho' => null,
        'codigoPedido' => null,
        'mes' => 0,
        'ano' => 0,
        'limite' => 0,
        'comMetodosDePagamento' => array(),
    );

    /**
     * @param $orderNumber
     * @param PaymentMethodCollection $paymentMethods
     */
    public function __construct($orderNumber, PaymentMethodCollection $paymentMethods = null)
    {
        $this->codigoPedido = $orderNumber;
        $this->comMetodosDePagamento = $paymentMethods;
    }

    /**
     * @return int
     */
    public function getOrderNumber()
    {
        return $this->codigoPedido;
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
