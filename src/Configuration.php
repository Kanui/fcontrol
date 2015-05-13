<?php

namespace FControl;

class Configuration implements ConfigurationInterface
{
    private $baseUrl;
    private $login;
    private $password;
    private $storeId;
    private $isTest = false;

    /**
     * @param string $baseUrl
     * @param string $login
     * @param string $password
     * @param string $storeId
     * @param bool $isTest
     */
    public function __construct($baseUrl, $login, $password, $storeId = null, $isTest = false)
    {
        $this->baseUrl = $baseUrl;
        $this->login = $login;
        $this->password = $password;
        $this->storeId = $storeId;
        $this->isTest = $isTest;
    }

    /**
     * @inheritdoc
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @inheritdoc
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @inheritdoc
     */
    public function isTest()
    {
        return $this->isTest;
    }
}
