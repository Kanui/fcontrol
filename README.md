FControl Integration API
========================

FControl is a risk management system which analyses a purchase order
and define type of risk it can represents for your virtual store.

Can you take a look more about it in [FControl Website](https://www.fcontrol.com.br/)

Usage
-----

Before, you need to take your credentials with FControl Commercial Team.

Install the latest version with `composer require kanui/fcontrol`

### Send Order

Send an order transaction to be analyzed by FControl.

#### How To

```php
<?php

use FControl\Configuration;
use FControl\SoapClient;
use FControl\Message\PublishResponse;
use FControl\Tests\Providers\Order as OrderProvider;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$configuration = new Configuration('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

$client = new SoapClient($configuration);

// it will generate a dynamic order to be sent
$order = new OrderProvider();

$response = $client->publish($order);

echo $response->getMessage();
```

### Capture Order Status

After send a transaction to be analyzed by FControl System, you should capture
the risk analysis for this transaction. The transaction can be reviewed by
analyst or a specific queue with its rules. And on complete analysis, the
transaction will be available with its results.

#### How To

```php
<?php

use FControl\Configuration;
use FControl\Message\CaptureResponse;
use FControl\Parameter\CaptureOrder;
use FControl\SoapClient;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$configuration = new Configuration('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

$client = new SoapClient($configuration);

$response = $client->captureOrder(new CaptureOrder(9900));

if ($response->isSuccess()) {
    echo $response->getStatus()->getName();
} else {
    echo $response->getMessage();
}
```

### Confirm Order Status

After capture an analysis, you should confirm that receipt was successful.
If not confirm this analysis will always be available for capture.

#### How To

```php
<?php

use FControl\Configuration;
use FControl\SoapClient;
use FControl\Message\ConfirmResponse;
use FControl\Parameter\ConfirmOrder;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$configuration = new Configuration('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

$client = new SoapClient($configuration);

$response = $client->confirmOrder(new ConfirmOrder(9900));

echo $response->getMessage();
```

### Change Order Status

Change transaction status manually without use FControl Interface.
If you have a internal process or need reject a order in FControl
System, you can use this method.

#### How To

```php
<?php

use FControl\Configuration;
use FControl\SoapClient;
use FControl\Message\OrderStatusResponse;
use FControl\Parameter\ConfirmOrder;
use FControl\Parameter\Reason;
use FControl\Parameter\Status;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$configuration = new Configuration('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

$client = new SoapClient($configuration);

$orderStatus = new OrderStatus(9900, new Status(Status::CANCELLED_SUSPECT), new Reason(Reason::DIVERGENT_ADDRESS));

$response = $client->changeStatus($orderStatus);

echo $response->getMessage();
```

About
-----

### Requirements

FControl library works with PHP 5.3+ and above, and need Soap Extension.

### Contributing

Bugs and feature request are tracked on [GitHub](https://github.com/Kanui/fcontrol/issues)

### License

FControl Library is licensed under the MIT License - see the `[LICENSE](https://github.com/Kanui/fcontrol/blob/master/LICENSE)`
 file for details/

### Acknowledgements

This library not have all operations to integrate fully with FControl System,
but have the base to get a simple and quick integration with it.
Trip transactions is not available yet, but you can implementing it and send
us a PR.