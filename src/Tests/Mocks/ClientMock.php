<?php

namespace FControl\Tests\Mocks;

use FControl\Client\ClientInterface;
use FControl\ConfigurationInterface;
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
use FControl\Tests\Providers\Message\CaptureOrderCollectionSuccessful;
use FControl\Tests\Providers\Message\ConfirmSuccessful;
use FControl\Tests\Providers\Message\OrderStatusSuccessful;
use FControl\Tests\Providers\Message\PublishFailed;
use FControl\Tests\Providers\Message\PublishSuccessful;
use FControl\Tests\Providers\Message\CaptureSuccessful;

class ClientMock implements ClientInterface
{

    /**
     * Get the configuration of service.
     * @return ConfigurationInterface
     */
    public function getConfiguration()
    {
        return;
    }

    /**
     * It will simulate a send order transaction to be analyzed by FControl.
     * @param Order $order Order to be publish.
     * @return PublishResponse For Success Response, try to send Order EVEN Grand Total otherwise ODD Grand Total
     */
    public function publish(Order $order)
    {
        $serviceResponse = new PublishFailed($order);
        if (($order->getGrandTotal() % 2) == 0) {
            $serviceResponse = new PublishSuccessful($order);
        }

        return new PublishResponse($serviceResponse);
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
        return new CaptureResponse(new CaptureSuccessful($order));
    }

    /**
     * Is similar to captureOrder, but it will query all orders.
     * @param CaptureOrderCollection $collection Query orders based on month and payment methods.
     * @return CaptureCollectionResponse Service response with a collection of capture data, but only if they were
     *                                   analyzed by an analyst or automatic queue.
     */
    public function captureCollectionOrder(CaptureOrderCollection $collection)
    {
        return new CaptureCollectionResponse(new CaptureOrderCollectionSuccessful($collection));
    }

    /**
     * After capture an analysis, you should confirm that receipt was successful.
     * If not confirm this analysis will always be available for capture.
     * @param ConfirmOrder $order Order to be confirmed.
     * @return ConfirmResponse Service response with message if confirmation was successful or failed.
     */
    public function confirmOrder(ConfirmOrder $order)
    {
        return new ConfirmResponse(new ConfirmSuccessful($order));
    }

    /**
     * Change transaction status manually without use FControl Interface.
     * @param OrderStatus $order Order to be change status.
     * @return OrderStatusResponse Service response with message if status changed successful or failed.
     */
    public function changeStatus(OrderStatus $order)
    {
        return new OrderStatusResponse(new OrderStatusSuccessful($order));
    }
}
