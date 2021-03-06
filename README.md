FControl Integration API
========================

[![Latest Stable Version](https://poser.pugx.org/kanui/fcontrol/v/stable)](https://packagist.org/packages/kanui/fcontrol)
[![Total Downloads](https://poser.pugx.org/kanui/fcontrol/downloads)](https://packagist.org/packages/kanui/fcontrol)
[![License](https://poser.pugx.org/kanui/fcontrol/license)](https://packagist.org/packages/kanui/fcontrol)

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

use FControl\RiskManager;
use FControl\Tests\Providers\Order as OrderProvider;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$riskManager = RiskManager::create('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

// it will generate a dynamic order to be sent
$order = new OrderProvider();

$response = $riskManager->publish($order);

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

use FControl\RiskManager;
use FControl\Parameter\CaptureOrder;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$riskManager = RiskManager::create('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

$response = $riskManager->captureOrder(new CaptureOrder(9900));

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

use FControl\RiskManager;
use FControl\Parameter\ConfirmOrder;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$riskManager = RiskManager::create('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

$response = $riskManager->confirmOrder(new ConfirmOrder(9900));

echo $response->getMessage();
```

### Change Order Status

Change transaction status manually without use FControl Interface.
If you have a internal process or need reject a order in FControl
System, you can use this method.

#### How To

```php
<?php

use FControl\RiskManager;
use FControl\Parameter\ConfirmOrder;
use FControl\Parameter\Reason;
use FControl\Parameter\Status;

// store id is used if you have many stores in FControl system
$storeId = null;

// define if is test environment
$isTestEnvironment = true;

$riskManager = RiskManager::create('https://fcontrol.test/?wsdl', 'username', 'password', $storeId, $isTestEnvironment);

$orderStatus = new OrderStatus(9900, new Status(Status::CANCELLED_SUSPECT), new Reason(Reason::DIVERGENT_ADDRESS));

$response = $riskManager->changeStatus($orderStatus);

echo $response->getMessage();
```

About
-----

### Requirements

FControl library works with PHP 5.3+ and above, and need Soap Extension.

### Contributing

Bugs and feature request are tracked on [GitHub](https://github.com/Kanui/fcontrol/issues)

### License

FControl Library is licensed under the MIT License - see the [LICENSE](https://github.com/Kanui/fcontrol/blob/master/LICENSE)
 file for details

### Acknowledgements

This library not have all operations to integrate fully with FControl System,
but have the base to get a simple and quick integration with it.
Trip transactions is not available yet, but you can implementing it and send
us a PR.