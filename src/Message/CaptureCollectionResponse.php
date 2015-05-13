<?php

namespace FControl\Message;

class CaptureCollectionResponse extends AbstractResponse implements ResponseInterface, \Iterator, \Countable
{
    private $position = 0;
    private $collection = array();

    public function __construct(\stdClass $soapResponse)
    {
        if (!property_exists($soapResponse, 'capturarResultadosTodasSubLojas4Result')) {
            throw new \LogicException('Cannot find expected node on Soap Response');
        }
        $transaction = $soapResponse->capturarResultadosTodasSubLojas4Result;
        $this->setSuccess(isset($transaction->WsAnaliseTodasSublojas3));

        if(!$this->isSuccess()){
            $this->setMessage('Not data found to capture.');
        }

        if (!is_array($transaction->WsAnaliseTodasSublojas3)) {
            $transaction->WsAnaliseTodasSublojas3 = array($transaction->WsAnaliseTodasSublojas3);
        }

        $this->position = 0;
        $this->append($transaction->WsAnaliseTodasSublojas3);
    }

    private function append(array $transactions)
    {
        foreach ($transactions as $orderResponse) {
            $captureResponse = new \stdClass();
            $captureResponse->capturarResultadoEspecificoSubLoja3Result = $orderResponse;
            $capture = new CaptureResponse($captureResponse);
            $this->collection[] = $capture;
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->collection[$this->position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return count($this->collection);
    }
}
