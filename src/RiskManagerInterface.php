<?php

namespace FControl;

use FControl\Client\ClientInterface;

interface RiskManagerInterface extends ClientInterface
{
    /**
     * @param string $baseUrl
     * @param string $login
     * @param string $password
     * @param string $storeId
     * @param bool $isTest
     * @return RiskManagerInterface
     */
    public static function create($baseUrl, $login, $password, $storeId = null, $isTest = false);

    /**
     * Get current available client.
     * @return ClientInterface
     */
    public function getClient();
}
