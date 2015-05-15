<?php

namespace FControl\Client;

use FControl\ConfigurationInterface;
use FControl\Message\CaptureCollectionResponse;
use FControl\Message\CaptureResponse;
use FControl\Message\ConfirmResponse;
use FControl\Message\OrderStatusResponse;
use FControl\Message\PublishResponse;
use FControl\Parameter\Authentication;
use FControl\Parameter\CaptureOrderCollection;
use FControl\Parameter\CaptureOrder;
use FControl\Parameter\ConfirmOrder;
use FControl\Parameter\Order;
use FControl\Parameter\OrderStatus;

class SoapClient extends \SoapClient implements ClientInterface
{
    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;

        $soapConfig = array(
            'soap_version' => SOAP_1_2,
            'trace' => true,
            'exception' => true
        );
        parent::__construct($configuration->getBaseUrl(), $soapConfig);
    }

    /**
     * Get the configuration of service.
     * @return ConfigurationInterface
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Send an order transaction to be analyzed by FControl.
     * @param Order $order Order to be publish.
     * @return PublishResponse Service response success true when adds on queue your transaction.
     */
    public function publish(Order $order)
    {
        $order->setAuthentication(Authentication::createFromConfiguration($this->getConfiguration()));
        $order->setTest($this->getConfiguration()->isTest());
        $response = $this->__soapCall('enfileirarTransacao9', array(array('pedido' => $order->toArray())));
        return new PublishResponse($response);
    }

    /**
     * After send a transaction to be analyzed by FControl,
     * you should capture the risk analysis for this transaction.
     * The transaction can be reviewed by analyst or a specific queue with its rules.
     * And after of complete analysis, the transaction will be available with its results.
     * @param CaptureOrder $order Order to be capture.
     * @return CaptureResponse Service response with capture data when find your order number
     *                         and it was analyzed by an analyst or automatic queue.
     */
    public function captureOrder(CaptureOrder $order)
    {
        $order->setAuthentication($this->getConfiguration());
        try {
            $response = $this->__soapCall('capturarResultadoEspecificoSubLoja3', array($order->toArray()));
        } catch (\SoapFault $fault) {
            $response = new \stdClass();
            $response->capturarResultadoEspecificoSubLoja3Result = new \stdClass();
            $response->capturarResultadoEspecificoSubLoja3Result->Sucesso = false;
            $response->capturarResultadoEspecificoSubLoja3Result->Mensagem = preg_replace('/(.*System\.Exception: |[\s]+em WSFControl2.*|[\s]+ ---.*)/', '', $fault->getMessage());
        }
        return new CaptureResponse($response);
    }

    /**
     * Is similar to captureOrder, but it will query all orders.
     * @param CaptureOrderCollection $collection Query orders based on month and payment methods.
     * @return CaptureCollectionResponse Service response with a collection of capture data, but only if they were
     *                                   analyzed by an analyst or automatic queue.
     */
    public function captureCollectionOrder(CaptureOrderCollection $collection)
    {
        $collection->setAuthentication($this->getConfiguration());
        $response = $this->__soapCall('capturarResultadosTodasSubLojas4', array($collection->toArray()));
        return new CaptureCollectionResponse($response);
    }

    /**
     * After capture an analysis, you should confirm that receipt was successful.
     * If not confirm this analysis will always be available for capture.
     * @param ConfirmOrder $order Order to be confirmed.
     * @return ConfirmResponse Service response with message if confirmation was successful or failed.
     */
    public function confirmOrder(ConfirmOrder $order)
    {
        $order->setAuthentication($this->getConfiguration());
        $response = $this->__soapCall('confirmarRetornoSubLoja', array($order->toArray()));
        return new ConfirmResponse($response);
    }

    /**
     * Change transaction status manually without use FControl Interface.
     * @param OrderStatus $order Order to be change status.
     * @return OrderStatusResponse Service response with message if status changed successful or failed.
     */
    public function changeStatus(OrderStatus $order)
    {
        $order->setAuthentication($this->getConfiguration());
        $response = $this->__soapCall('alterarStatusSubLoja2', array($order->toArray()));
        return new OrderStatusResponse($response);
    }
}
