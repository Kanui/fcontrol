<?php

namespace FControl\Parameter;

use FControl\Parameter\Payment\CreditCard;

class Payment extends AbstractParameter
{
    protected $parameters = array(
        'MetodoPagamento' => null,
        'Cartao' => null,
        'Valor' => null,
        'NumeroParcelas' => null,
        'Nsu' => null,
    );

    /**
     * @param PaymentMethod $paymentMethod
     * @param int $installments
     * @param $value
     * @param int $nsu
     * @param CreditCard $creditCard
     */
    public function __construct(PaymentMethod $paymentMethod, $installments, $value, $nsu = null, CreditCard $creditCard = null)
    {
        $this->MetodoPagamento = $paymentMethod;
        $this->Cartao = $creditCard;
        $this->Valor = $value;
        $this->NumeroParcelas = $installments;
        $this->Nsu = $nsu;
    }
}
