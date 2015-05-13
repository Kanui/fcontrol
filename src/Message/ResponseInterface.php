<?php

namespace FControl\Message;

interface ResponseInterface
{
    /**
     * @return mixed
     */
    public function isSuccess();

    /**
     * @return mixed
     */
    public function getCode();

    /**
     * @return mixed
     */
    public function getMessage();
}
