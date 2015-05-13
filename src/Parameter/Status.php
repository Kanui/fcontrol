<?php

namespace FControl\Parameter;

/**
 * @package FControl\Parameter
 */
class Status extends AbstractEnumerator
{
    const NEGATIVE = 'Nulo';
    const PENDING = 'Pendente';
    const SENT = 'Enviado';
    const CANCELLED = 'Cancelado';
    const WAITING_DOCUMENTS = 'AguardandoDocumentacao';
    const CANCELED_NO_SUSPECION = 'CanceladoSemSuspeita';
    const CANCELLED_SUSPECT = 'CanceladoSuspeita';
    const APPROVED = 'Aprovada';
    const WAITING = 'EmEspera';
    const REQUESTED_SUPERVISION = 'SolicitadaSupervisao';
    const FRAUD_CONFIRMED = 'FraudeConfirmada';
    const RECOVERING_LOSS = 'EmRecuperacaoPerda';
    const RECOVERED = 'Recuperado';
    const NOT_APPROVED_BY_OPERATOR = 'DesaprovadoOperadora';
    const UNCANCELED = 'Descancelado';
    const REVIEW_AGAIN = 'ReAnalise';
    const WAITING_DOCUMENT_GENERAL_QUEUE = 'AguardandoDocumentacaoFilaGeral';
    const REQUESTED_CONTACT = 'SolicitadoContato';
    const CONTACT_PERFORMED = 'ContatoEfetuado';
    const RECOVERING_SALE = 'EmRecuperacaoVenda';
    const SALE_RECOVERED = 'VendaRecuperada';
    const RECOVERING_SALE_SCHEDULED = 'EmRecuperacaoVendaAgendada';
    const APPROVED_BY_OPERATOR = 'AprovadoOperadora';
    const PRE_APPROVED = 'PreAprovado';
    const PRE_CANCELLED = 'PreCancelado';
    const Pre_CANCELLED_SUSPECT = 'PreCanceladoSuspeita';
    const PRE_FRAUD_CONFIRMED = 'PreFraudeConfirmada';
    const PRIORITY_REVIEW = 'AnalisePrioritaria';
    const REDISTRIBUTED = 'Redistribuido';

    protected $codeNames = array(
        1 => Status::PENDING,
        2 => Status::SENT,
        3 => Status::CANCELLED,
        6 => Status::CANCELLED_SUSPECT,
        7 => Status::APPROVED,
        10 => Status::FRAUD_CONFIRMED,
        13 => Status::NOT_APPROVED_BY_OPERATOR,
    );

    public function jsonSerialize()
    {
        return $this->getName();
    }
}
