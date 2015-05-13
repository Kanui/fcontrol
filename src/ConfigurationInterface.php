<?php

namespace FControl;


interface ConfigurationInterface
{
    /**
     * Get wsdl.
     * @return string
     */
    public function getBaseUrl();

    /**
     * Get username.
     * @return string
     */
    public function getLogin();

    /**
     * Get password.
     * @return string
     */
    public function getPassword();

    /**
     * Get store id.
     * @return string
     */
    public function getStoreId();

    /**
     * Is test environment.
     * @return boolean
     */
    public function isTest();
}
