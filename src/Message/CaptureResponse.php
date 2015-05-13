<?php

namespace FControl\Message;

use FControl\Parameter\Risk;
use FControl\Parameter\Status;

class CaptureResponse extends AbstractResponse
{
    private $store;
    private $orderNumber;
    private $status;
    private $reason;
    private $comment;
    private $analyst;
    private $email;
    private $extensionLine;
    private $phone;
    private $score;
    private $risk;

    protected $mappingNodes = array(
        'IdentificadorLoja' => 'store',
        'CodigoCompra' => 'orderNumber',
        'Status' => 'status',
        'CodigoMotivo' => 'reason',
        'Comentario' => 'comment',
        'Analista' => 'analyst',
        'Email' => 'email',
        'Ramal' => 'extensionLine',
        'Telefone' => 'phone',
        'OpiniaoFcontrol' => 'risk',
        'Score' => 'score',
    );

    public function __construct(\stdClass $soapResponse)
    {
        $isTransactionForSpecificOrder = property_exists($soapResponse, 'capturarResultadoEspecificoSubLoja3Result');
        if (!$isTransactionForSpecificOrder) {
            throw new \LogicException('Cannot find expected node on Soap Response');
        }
        $transaction = $soapResponse->capturarResultadoEspecificoSubLoja3Result;
        $this->setSuccess($transaction);
        $this->setCodeAndMessage($transaction);
        $this->setMappingNodes($transaction);
    }

    protected function setMappingNodes(\stdClass $object)
    {
        foreach ($this->mappingNodes as $nodeName => $property) {
            if (property_exists($object, $nodeName)) {
                $this->__set($property, $object->$nodeName);
            }
        }
        if (!is_null($this->getOrderNumber())) {
            $this->setSuccess(true);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (!method_exists($this, $method)) {
            $this->$name = $value;
        } else {
            $this->$method($value);
        }
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    protected function setStatus($status)
    {
        $this->status = new Status($status);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return mixed
     */
    public function getAnalyst()
    {
        return $this->analyst;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getExtensionLine()
    {
        return $this->extensionLine;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return Risk
     */
    public function getRisk()
    {
        return $this->risk;
    }

    protected function setRisk($risk)
    {
        $this->risk = new Risk($risk);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return mixed
     */
    public function getStore()
    {
        return $this->store;
    }
}
