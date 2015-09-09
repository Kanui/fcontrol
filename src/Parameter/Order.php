<?php

namespace FControl\Parameter;

/**
 * Class Order
 * @package FControl\Parameter
 */
class Order extends AbstractParameter
{
    /**
     * If your application is Integrator, find your code with FControl support.
     */
    const INTEGRATOR_CODE_UNKNOWN = 0;

    protected $parameters = array(
        'DadosUsuario' => null,
        'DadosComprador' => null,
        'DadosEntrega' => null,
        'Pagamentos' => null,
        'CodigoPedido' => null,
        'CodigoPedido2' => null,
        'DataCompra' => null,
        'DataEntrega' => null,
        'QuantidadeItensDistintos' => null,
        'QuantidadeTotalItens' => null,
        'ValorTotalCompra' => null,
        'ValorTotalFrete' => null,
        'PedidoDeTeste' => null,
        'PrazoEntregaDias' => null,
        'FormaEntrega' => null,
        'Observacao' => null,
        'CanalVenda' => null,
        'Produtos' => null,
        'DadosExtra' => null,
        'StatusFinalizador' => null,
        'CodigoIntegrador' => self::INTEGRATOR_CODE_UNKNOWN,
    );

    /**
     * @param $orderNumber
     * @param \DateTime $purchasedAt
     * @param float $grandTotal
     * @param Buyer $buyer
     * @param Delivery $delivery
     * @param PaymentCollection $payments
     * @param ProductCollection $products
     * @param Status $status
     * @param int $integratorCode
     */
    public function __construct(
        $orderNumber,
        \DateTime $purchasedAt,
        $grandTotal,
        Buyer $buyer,
        Delivery $delivery,
        PaymentCollection $payments,
        ProductCollection $products,
        Status $status,
        $integratorCode = self::INTEGRATOR_CODE_UNKNOWN
    )
    {
        $this->CodigoPedido = $orderNumber;
        $this->DataCompra = $purchasedAt;
        $this->ValorTotalCompra = ($grandTotal * 100);
        $this->DadosComprador = $buyer;
        $this->DadosEntrega = $delivery;
        $this->Produtos = $products;
        $this->Pagamentos = $payments;
        $this->StatusFinalizador = $status;
        $this->CodigoIntegrador = $integratorCode;
    }

    /**
     * @return int
     */
    public function getOrderNumber()
    {
        return $this->CodigoPedido;
    }

    /**
     * Gets order grand total.
     * @return float
     */
    public function getGrandTotal()
    {
        return $this->ValorTotalCompra;
    }

    /**
     * @param Authentication $authentication
     * @return Order
     */
    public function setAuthentication(Authentication $authentication)
    {
        $this->DadosUsuario = $authentication;
        return $this;
    }

    /**
     * @param \DateTime $deliveryAt
     * @return Order
     */
    public function setDeliveryAt(\DateTime $deliveryAt)
    {
        $this->DataEntrega = $deliveryAt;
        return $this;
    }

    /**
     * Append extra data.
     * @param string $data
     * @return Order
     */
    public function addExtraData($data)
    {
        $extraData = $this->DadosExtra;
        $count = count($extraData) + 1;
        $extraData['Extra' . $count] = $data;
        $this->DadosExtra = $extraData;
        return $this;
    }

    /**
     * @param string $channel
     * @return $this
     */
    public function setSalesChannel($channel)
    {
        $this->CanalVenda = $channel;
        return $this;
    }

    public function setDeliveryType($deliveryType)
    {
        $this->FormaEntrega = $deliveryType;
        return $this;
    }

    public function setDeliveryDate(\DateTime $deliveryDate)
    {
        $this->DataEntrega = $deliveryDate;
        return $this;
    }

    public function setFreightTotal($freightTotal)
    {
        $this->ValorTotalFrete = ($freightTotal * 100);
        return $this;
    }

    /**
     * @return ProductCollection
     */
    public function getProducts()
    {
        return $this->Produtos;
    }

    /**
     * @param bool $isTest
     * @return bool
     */
    public function setTest($isTest = true)
    {
        $this->PedidoDeTeste = $isTest;
        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $data = $this->parameters;
        if ($this->DataCompra instanceof \DateTime) {
            $data['DataCompra'] = $this->DataCompra->format('Y-m-d\TH:i:s');
        }
        if ($this->DataEntrega instanceof \DateTime) {
            $data['DataEntrega'] = $this->DataEntrega->format('Y-m-d\TH:i:s');
            $interval = $this->DataEntrega->diff($this->DataCompra);
            $includePurchaseDay = 1;
            $data['PrazoEntregaDias'] = $interval->days + $includePurchaseDay;
        }
        $data['QuantidadeItensDistintos'] = $this->getProducts()->countDifferentItems();
        $data['QuantidadeTotalItens'] = $this->getProducts()->count();
        return $data;
    }
}
