<?php

namespace FControl\Parameter;

use FControl\Configuration;

class CaptureOrderCollection extends AbstractParameter
{
    protected $parameters = array(
        'login' => null,
        'senha' => null,
        'mes' => 0,
        'ano' => 0,
        'limite' => 0,
        'comMetodosDePagamento' => array(),
    );

    /**
     * @param \DateTime $date Date to get orders, if NULL is given not filter by date.
     * @param int $limit Number of registers to response.
     * @param PaymentMethodCollection $paymentMethods Collection of payment methods to filter response.
     */
    public function __construct(\DateTime $date = null, $limit = 100, PaymentMethodCollection $paymentMethods = null)
    {
        if($date instanceof \DateTime){
            $this->mes = $date->format('m');
            $this->ano = $date->format('Y');
        }
        $this->limite = $limit;
        $this->comMetodosDePagamento = $paymentMethods;
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
