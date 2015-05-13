<?php

namespace FControl\Message;

abstract class AbstractResponse implements ResponseInterface
{
    private $isSuccess;
    private $code;
    private $message;

    /**
     * @param $transaction
     */
    protected function setSuccess($transaction)
    {
        $isSuccess = false;
        if (is_bool($transaction)) {
            $isSuccess = $transaction;
        }
        if (is_object($transaction) && property_exists($transaction, 'Sucesso')) {
            $isSuccess = $transaction->Sucesso;
        }
        $this->isSuccess = $isSuccess;
    }

    protected function setCodeAndMessage($object)
    {
        if (property_exists($object, 'Mensagem')) {
            list($code, $message) = explode('|', $object->Mensagem);
            $this->setCode($code);
            $this->setMessage($message);
        }
    }

    /**
     * @param int $code
     */
    protected function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param string $message
     */
    protected function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function isSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}
