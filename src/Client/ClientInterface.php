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

interface ClientInterface
{
    /**
     * Get the configuration of service.
     * @return ConfigurationInterface
     */
    public function getConfiguration();

    /**
     * Send an order transaction to be analyzed by FControl.
     * @param Order $order Order to be publish.
     * @return PublishResponse Service response success true when adds on queue your transaction.
     */
    public function publish(Order $order);

    /**
     * After send a transaction to be analyzed by FControl,
     * you should capture the risk analysis for this transaction.
     * The transaction can be reviewed by analyst or a specific queue with its rules.
     * And after of complete analysis, the transaction will be available with its results.
     * @param CaptureOrder $order Order to be capture.
     * @return CaptureResponse Service response with capture data when find your order number
     *                         and it was analyzed by an analyst or automatic queue.
     */
    public function captureOrder(CaptureOrder $order);

    /**
     * Is similar to captureOrder, but it will query all orders.
     * @param CaptureOrderCollection $collection Query orders based on month and payment methods.
     * @return CaptureCollectionResponse Service response with a collection of capture data, but only if they were
     *                                   analyzed by an analyst or automatic queue.
     */
    public function captureCollectionOrder(CaptureOrderCollection $collection);

    /**
     * After capture an analysis, you should confirm that receipt was successful.
     * If not confirm this analysis will always be available for capture.
     * @param ConfirmOrder $order Order to be confirmed.
     * @return ConfirmResponse Service response with message if confirmation was successful or failed.
     */
    public function confirmOrder(ConfirmOrder $order);

    /**
     * Change transaction status manually without use FControl Interface.
     * @param OrderStatus $order Order to be change status.
     * @return OrderStatusResponse Service response with message if status changed successful or failed.
     */
    public function changeStatus(OrderStatus $order);
}
