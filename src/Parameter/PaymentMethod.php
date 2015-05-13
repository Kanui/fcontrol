<?php

namespace FControl\Parameter;

/**
 * @package FControl\Parameter
 */
class PaymentMethod extends AbstractEnumerator
{
    const CREDITCARD = 'CartaoCredito';
    const CREDITCARD_VISA = 'CartaoVisa';
    const CREDITCARD_MASTERCARD = 'CartaoMasterCard';
    const CREDITCARD_DINERS = 'CartaoDiners';
    const CREDITCARD_AMERICAN_EXPRESS = 'CartaoAmericanExpress';
    const CREDITCARD_HIPERCARD = 'CartaoHiperCard';
    const CREDITCARD_AURA = 'CartaoAura';
    const CREDITCARD_MARISA = 'CartaoMarisa';
    const CREDITCARD_PONTO_FRIO = 'CartaoPontoFrio';
    const CREDITCARD_PAO_ACUCAR = 'CartaoPaoAcucar';
    const CREDITCARD_SORO_CRED = 'CartaoSoroCred';
    const CREDITCARD_PRESENTE_EXTRA = 'CartaoPresenteExtra';
    const PAY_ON_DELIVERY = 'PagamentoEntrega';
    const DEBIT_ONLINE_TRANSACTION = 'DebitoTransferenciaEletronica';
    const BOLETO = 'BoletoBancario';
    const GIFT_CARD = 'ValePresente';

    protected $parameters = array('value' => null);
    protected $codeNames = array(
        1 => PaymentMethod::CREDITCARD,
        2 => PaymentMethod::CREDITCARD_VISA,
        3 => PaymentMethod::CREDITCARD_MASTERCARD,
        4 => PaymentMethod::CREDITCARD_DINERS,
        5 => PaymentMethod::CREDITCARD_AMERICAN_EXPRESS,
        6 => PaymentMethod::CREDITCARD_HIPERCARD,
        7 => PaymentMethod::CREDITCARD_AURA,
        10 => PaymentMethod::PAY_ON_DELIVERY,
        11 => PaymentMethod::DEBIT_ONLINE_TRANSACTION,
        12 => PaymentMethod::BOLETO,
        18 => PaymentMethod::GIFT_CARD,
    );

    /**
     * @param string $paymentMethod
     */
    public function __construct($paymentMethod)
    {
        $this->check($paymentMethod);
        $this->value = $this->translate($paymentMethod);
        $this->code = $this->getCodeFromName($paymentMethod);
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}