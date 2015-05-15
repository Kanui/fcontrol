<?php

namespace FControl;

use FControl\Client\ClientInterface;
use FControl\Client\SoapClient;
use FControl\Message\CaptureCollectionResponse;
use FControl\Message\CaptureResponse;
use FControl\Message\ConfirmResponse;
use FControl\Message\OrderStatusResponse;
use FControl\Message\PublishResponse;
use FControl\Parameter\CaptureOrder;
use FControl\Parameter\CaptureOrderCollection;
use FControl\Parameter\ConfirmOrder;
use FControl\Parameter\Order;
use FControl\Parameter\OrderStatus;

class RiskManager implements RiskManagerInterface
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;
    /**
     * @var ClientInterface
     */
    private $client;

    protected function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
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
     * @return ClientInterface
     */
    public function getClient()
    {
        if (!$this->client instanceof ClientInterface) {
            $this->client = new SoapClient($this->getConfiguration());
        }
        return $this->client;
    }

    /**
     * Send an order transaction to be analyzed by FControl.
     * @param Order $order Order to be publish.
     * @return PublishResponse Service response success true when adds on queue your transaction.
     */
    public function publish(Order $order)
    {
        return $this->getClient()->publish($order);
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
        return $this->getClient()->captureOrder($order);
    }

    /**
     * Is similar to captureOrder, but it will query all orders.
     * @param CaptureOrderCollection $collection Query orders based on month and payment methods.
     * @return CaptureCollectionResponse Service response with a collection of capture data, but only if they were
     *                                   analyzed by an analyst or automatic queue.
     */
    public function captureCollectionOrder(CaptureOrderCollection $collection)
    {
        return $this->getClient()->captureCollectionOrder($collection);
    }

    /**
     * After capture an analysis, you should confirm that receipt was successful.
     * If not confirm this analysis will always be available for capture.
     * @param ConfirmOrder $order Order to be confirmed.
     * @return ConfirmResponse Service response with message if confirmation was successful or failed.
     */
    public function confirmOrder(ConfirmOrder $order)
    {
        return $this->getClient()->confirmOrder($order);
    }

    /**
     * Change transaction status manually without use FControl Interface.
     * @param OrderStatus $order Order to be change status.
     * @return OrderStatusResponse Service response with message if status changed successful or failed.
     */
    public function changeStatus(OrderStatus $order)
    {
        return $this->getClient()->changeStatus($order);
    }

    /**
     * @param string $baseUrl
     * @param string $login
     * @param string $password
     * @param string $storeId
     * @param bool $isTest
     * @return ConfigurationInterface
     */
    public static function create($baseUrl, $login, $password, $storeId = null, $isTest = false)
    {
        $configuration = new Configuration($baseUrl, $login, $password, $storeId, $isTest);

        return new static($configuration);
    }
}
