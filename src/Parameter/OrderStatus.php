<?php

namespace FControl\Parameter;

use FControl\Configuration;
use FControl\ConfigurationInterface;

class OrderStatus extends AbstractParameter
{
    protected $parameters = array(
        'login' => null,
        'senha' => null,
        'identificadorLojaFilho' => null,
        'codigoPedido' => null,
        'status' => null,
        'codigoMotivo' => null,
        'comentario' => null,
        'compartilharComentario' => true,
    );

    /**
     * @param $orderNumber
     * @param Status $status
     * @param Reason $reason
     * @param null $comment
     * @param bool $isSharedComment
     */
    public function __construct($orderNumber, Status $status, Reason $reason, $comment = null, $isSharedComment = true)
    {
        $this->codigoPedido = $orderNumber;
        $this->status = $status;
        $this->codigoMotivo = $reason;
        $this->comentario = $comment;
        $this->compartilharComentario = $isSharedComment;
    }

    /**
     * @return int
     */
    public function getOrderNumber()
    {
        return $this->codigoPedido;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Reason
     */
    public function getReason()
    {
        return $this->codigoMotivo;
    }

    /**
     * @param ConfigurationInterface $configuration
     */
    public function setAuthentication(ConfigurationInterface $configuration)
    {
        $this->login = $configuration->getLogin();
        $this->senha = $configuration->getPassword();
        $this->identificadorLojaFilho = $configuration->getStoreId();
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        $data['status'] = $this->getStatus()->getCode();
        $data['codigoMotivo'] = $this->getReason()->getCode();
        return $data;
    }
}
