<?php
namespace FControl\Tests\Client;

use FControl\Configuration;
use FControl\Parameter\CaptureOrderCollection;
use FControl\Parameter\CaptureOrder;
use FControl\Parameter\ConfirmOrder;
use FControl\Parameter\OrderStatus;
use FControl\Parameter\Reason;
use FControl\Parameter\Status;
use FControl\Client\SoapClient;
use FControl\Tests\Providers\Message\CaptureFailed;
use FControl\Tests\Providers\Message\CaptureOrderCollectionSuccessful;
use FControl\Tests\Providers\Message\CaptureSuccessful;
use FControl\Tests\Providers\Message\ConfirmSuccessful;
use FControl\Tests\Providers\Message\FailedInterface;
use FControl\Tests\Providers\Message\OrderStatusSuccessful;
use FControl\Tests\Providers\Message\PublishSuccessful;
use FControl\Tests\Providers\Message\ResponseInterface;
use FControl\Tests\Providers\Order as OrderProvider;

class SoapClientTest extends \PHPUnit_Framework_TestCase
{

    public function testIWantToPublishAPurchaseOrderAndExpectASuccessfulMessage()
    {
        $order = new OrderProvider();
        $expectedResponse = new PublishSuccessful($order);
        $client = $this->getMockSoapClient($expectedResponse);

        $response = $client->publish($order);

        $this->assertInstanceOf('\FControl\Message\PublishResponse', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(0, $response->getCode());
        $this->assertEquals('Transação enfileirada com sucesso', $response->getMessage());
    }

    public function testIWantToCaptureAPurchaseOrderAndExpectASuccessfulMessage()
    {
        $order = new CaptureOrder(9900);
        $expectedResponse = new CaptureSuccessful($order);

        $client = $this->getMockSoapClient($expectedResponse);
        $response = $client->captureOrder($order);
        $this->assertInstanceOf('\FControl\Message\CaptureResponse', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(9900, $response->getOrderNumber());
        $this->assertInstanceOf('\FControl\Parameter\Status', $response->getStatus());
        $this->assertEquals('Aprovada', $response->getStatus()->getName());
        $this->assertEquals(7, $response->getStatus()->getCode());
        $this->assertEquals(0, $response->getReason());
        $this->assertEmpty($response->getComment());
        $this->assertEmpty($response->getAnalyst());
        $this->assertEmpty($response->getEmail());
        $this->assertEmpty($response->getExtensionLine());
        $this->assertEmpty($response->getPhone());
        $this->assertInstanceOf('\FControl\Parameter\Risk', $response->getRisk());
        $this->assertEquals('Risco Baixo', $response->getRisk()->getName());
        $this->assertNotEmpty($response->getScore());
        $this->assertEmpty($response->getStore());
    }

    public function testIWantToConfirmAPurchaseOrderAndExpectASuccessfulMessage()
    {
        $order = new ConfirmOrder(9900);
        $expectedResponse = new ConfirmSuccessful($order);

        $client = $this->getMockSoapClient($expectedResponse);
        $response = $client->confirmOrder($order);
        $this->assertInstanceOf('\FControl\Message\ConfirmResponse', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(0, $response->getCode());
        $this->assertEquals('Retorno confirmado com sucesso.', $response->getMessage());
    }

    public function testIWantToCaptureCollectionOfOrdersAndExpectASuccessfulMessage()
    {
        $order = new CaptureOrderCollection(new \DateTime('now'), 2);
        $expectedResponse = new CaptureOrderCollectionSuccessful($order);

        $client = $this->getMockSoapClient($expectedResponse);
        $response = $client->captureCollectionOrder($order);
        $this->assertInstanceOf('\FControl\Message\CaptureCollectionResponse', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(2, $response->count());
        foreach ($response as $captureOrder) {
            $this->assertInstanceOf('\FControl\Message\CaptureResponse', $captureOrder);
        }
    }

    public function testIWantToCaptureOfOrderAPurchaseOrderAndExpectAFailedMessage()
    {
        $order = new CaptureOrder(123);
        $client = $this->getMockSoapClient(new CaptureFailed($order));
        $response = $client->captureOrder($order);
        $this->assertInstanceOf('\FControl\Message\CaptureResponse', $response);
        $this->assertFalse($response->isSuccess());
        $this->assertEquals(1, $response->getCode());
        $this->assertEquals('Some error occurred.', $response->getMessage());
    }

    public function testIWantToChangeOrderStatusAndExpectASuccessfulMessage()
    {
        $order = new OrderStatus(7659, new Status(Status::CANCELLED_SUSPECT), new Reason(Reason::DIVERGENT_ADDRESS));
        $client = $this->getMockSoapClient(new OrderStatusSuccessful($order));
        $response = $client->changeStatus($order);
        $this->assertInstanceOf('\FControl\Message\OrderStatusResponse', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(0, $response->getCode());
        $this->assertEquals('Status alterado com sucesso.', $response->getMessage());
    }

    /**
     * @param ResponseInterface $expectedResponse
     * @return SoapClient
     */
    protected function getMockSoapClient(ResponseInterface $expectedResponse)
    {
        $configuration = new Configuration('https://localhost.dev/', 'username', 'password', null, true);

        $mock = $this->getMockBuilder('FControl\Client\SoapClient')
            ->disableOriginalConstructor()
            ->setMethods(array('getConfiguration', '__call', '__soapCall'))
            ->getMock();
        $mock->expects($this->any())->method('getConfiguration')->will($this->returnValue($configuration));
        if ($expectedResponse instanceof FailedInterface) {
            $mock->expects($this->any())->method('__call')->will($this->throwException($expectedResponse));
            $mock->expects($this->any())->method('__soapCall')->will($this->throwException($expectedResponse));
        } else {
            $mock->expects($this->any())->method('__call')->will($this->returnValue($expectedResponse));
            $mock->expects($this->any())->method('__soapCall')->will($this->returnValue($expectedResponse));
        }
        return $mock;
    }
}
