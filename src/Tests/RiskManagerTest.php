<?php

namespace FControl\Tests;

use FControl\Parameter\CaptureOrder;
use FControl\Parameter\CaptureOrderCollection;
use FControl\Parameter\ConfirmOrder;
use FControl\Parameter\OrderStatus;
use FControl\Parameter\Reason;
use FControl\Parameter\Status;
use FControl\RiskManager;
use FControl\Tests\Mocks\ClientMock;
use FControl\Tests\Providers\Order as OrderProvider;
use Prophecy\Argument;

class RiskManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testIWantToCreateARiskManagerObject()
    {
        $riskManager = RiskManager::create('https://localhost.dev/', 'username', 'password', null, true);
        $this->assertInstanceOf('\FControl\RiskManager', $riskManager);
    }

    public function testIWantToPublishAnOrder()
    {
        $riskManager = $this->getMockRiskManager();
        $response = $riskManager->publish(new OrderProvider());
        $this->assertInstanceOf('\FControl\Message\ResponseInterface', $response);
        $this->assertTrue($response->isSuccess());
    }

    public function testIWantToCaptureAnOrder()
    {
        $riskManager = $this->getMockRiskManager();
        $response = $riskManager->captureOrder(new CaptureOrder(123));
        $this->assertInstanceOf('\FControl\Message\ResponseInterface', $response);
        $this->assertTrue($response->isSuccess());
    }

    public function testIWantToConfirmAnOrder()
    {
        $riskManager = $this->getMockRiskManager();
        $response = $riskManager->confirmOrder(new ConfirmOrder(123));
        $this->assertInstanceOf('\FControl\Message\ResponseInterface', $response);
        $this->assertTrue($response->isSuccess());
    }

    public function testIWantToCaptureOrderCollection()
    {
        $order = new CaptureOrderCollection(new \DateTime('now'), 2);

        $riskManager = $this->getMockRiskManager();
        $response = $riskManager->captureCollectionOrder($order);
        $this->assertInstanceOf('\FControl\Message\ResponseInterface', $response);
        $this->assertTrue($response->isSuccess());
    }

    public function testIWantToChangeOrderStatus()
    {
        $order = new OrderStatus(7659, new Status(Status::CANCELLED_SUSPECT), new Reason(Reason::DIVERGENT_ADDRESS));

        $riskManager = $this->getMockRiskManager();
        $response = $riskManager->changeStatus($order);
        $this->assertInstanceOf('\FControl\Message\ResponseInterface', $response);
        $this->assertTrue($response->isSuccess());
    }

    /**
     * @return \FControl\RiskManager
     */
    protected function getMockRiskManager()
    {
        $riskManager = $this->getMockBuilder('\FControl\RiskManager')
            ->disableOriginalConstructor()
            ->setMethods(array('getClient'))
            ->getMock();
        $riskManager->expects($this->any())->method('getClient')->willReturn(new ClientMock());
        return $riskManager;
    }
}
