<?php

namespace FControl\Parameter;

use FControl\Exceptions\ReasonNotFound;

/**
 * @package FControl\Parameter
 */
class Reason extends AbstractEnumerator
{
    const NO_REASON = 0;
    const THIRD_CARD_NOT_FOUND = 1;
    const CHARGEBACK_CUSTOMER_OF_THE_PREVIOUS_APPLICATION_WITH_FINANCIAL_LOSS = 30;
    const CHARGEBACK_CUSTOMER_OF_THE_PREVIOUS_APPLICATION_WITHOUT_FINANCIAL_LOSS = 36;
    const DISAGREEMENT_COMMERCIAL = 34;
    const WITHDRAWAL_CARD_BUYER_OR_OWNER = 2;
    const WITHDRAWAL_OF_THE_TENANT = 3;
    const DUPLICITY = 4;
    const ADDRESS_INCOMPLETE = 5;
    const RESTRICTIVE_HISTORY_IN_THE_MARKET = 6;
    const TENANT_FRAUD = 10;
    const SHOPKEEPER_SUSPECT = 7;
    const OTHER = 11;
    const ORDER_EXPIRED = 24;
    const PHONE_INCOMPLETE = 8;
    const CONTACT_FROM_UNSUCCESSFUL_ATTEMPTS = 9;
    const BILLET_LOSER = 37;
    const NO_ATTEMPTS_TEF_EXHAUSTED = 38;
    const TEMPORARILY_OUT_OF_STOCK = 39;
    const DISSATISFACTION_WITH_PRODUCT = 40;
    const DELAY_EXCHANGE = 41;
    const WRONG_PRODUCT = 42;
    const CREDIT_CARD_ISSUED_ABROAD = 12;
    const THIRD_CARD_UNIDENTIFIED = 13;
    const DISTURBING_BEHAVIOR_DURING_CONTACT = 23;
    const PERSONAL_INVALIDES = 14;
    const DIVERGENT_ADDRESS = 15;
    const FRAUD_IN_HISTORY_FCONTROL = 16;
    const TRANSACTION_HISTORY_IN_LOSS_RECOVERY = 22;
    const IN_TRANSACTIONS_HISTORY_SUSPENDED_IN_FCONTROL = 17;
    const DIVERGENT_PHONE = 18;
    const PHONE_INVALID = 19;
    const SELF_FRAUD_FINANCIAL_LOSS = 27;
    const SELF_FRAUD_WITHOUT_FINANCIAL_LOSS = 31;
    const BUYER_NOT_RECOGNIZED_TRANSACTION_WITH_FINANCIAL_LOSS = 20;
    const BUYER_ACKNOWLEDGES_NOT_WITHOUT_TRANSACTION_FINANCIAL_LOSS = 32;
    const FROM_IDENTITY_FRAUD = 28;
    const RELATED_FRAUD_FINANCIAL_LOSS = 29;
    const RELATED_FRAUD_WITHOUT_FINANCIAL_LOSS = 35;
    const HOLDER_CARD_NOT_RECOGNIZED_TRANSACTION_WITH_FINANCIAL_LOSS = 21;
    const HOLDER_CARD_NOT_RECOGNIZED_TRANSACTION_WITHOUT_FINANCIAL_LOSS = 33;

    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $code;
    protected $codeNames = array(
        self::NO_REASON => 'Quando não tiver o módulo de motivos ativado ou não for um status de Cancelado, Cancelado por Suspeita e Fraude Confirmada o código será 0 (Zero). Acessehttp://www.fcontrol.com.br/admin e clique no botão "Configurações" para habilitar o módulo Motivos de Cancelamento.',
        self::THIRD_CARD_NOT_FOUND => 'Cartão De Terceiro Não Localizado',
        self::CHARGEBACK_CUSTOMER_OF_THE_PREVIOUS_APPLICATION_WITH_FINANCIAL_LOSS => 'Chargeback em pedido anterior do cliente com Perda Financeira',
        self::CHARGEBACK_CUSTOMER_OF_THE_PREVIOUS_APPLICATION_WITHOUT_FINANCIAL_LOSS => 'Chargeback em pedido anterior do cliente sem Perda Financeira',
        self::DISAGREEMENT_COMMERCIAL => 'Desacordo Comercial',
        self::WITHDRAWAL_CARD_BUYER_OR_OWNER => 'Desistência do Comprador ou Titular do Cartão',
        self::WITHDRAWAL_OF_THE_TENANT => 'Desistência do Lojista',
        self::DUPLICITY => 'Duplicidade',
        self::ADDRESS_INCOMPLETE => 'Endereço Incompleto',
        self::RESTRICTIVE_HISTORY_IN_THE_MARKET => 'Histórico Restritivo No Mercado',
        self::TENANT_FRAUD => 'Lojista Fraudulento',
        self::SHOPKEEPER_SUSPECT => 'Lojista Suspeito',
        self::OTHER => 'Outros',
        self::ORDER_EXPIRED => 'Pedido Expirado',
        self::PHONE_INCOMPLETE => 'Telefone Incompleto',
        self::CONTACT_FROM_UNSUCCESSFUL_ATTEMPTS => 'Tentativas De Contato Sem Sucesso',
        self::BILLET_LOSER => 'Boleto Vencido',
        self::NO_ATTEMPTS_TEF_EXHAUSTED => 'Nº Tentativas TEF Esgotadas',
        self::TEMPORARILY_OUT_OF_STOCK => 'Estoque Esgotado',
        self::DISSATISFACTION_WITH_PRODUCT => 'Insatisfação com Produto',
        self::DELAY_EXCHANGE => 'Atraso Troca',
        self::WRONG_PRODUCT => 'Produto Errado',
        self::CREDIT_CARD_ISSUED_ABROAD => 'Cartão De Crédito Emitido No Exterior',
        self::THIRD_CARD_UNIDENTIFIED => 'Cartão De Terceiro Não Identificado',
        self::DISTURBING_BEHAVIOR_DURING_CONTACT => 'Comportamento Suspeito Durante Contato',
        self::PERSONAL_INVALIDES => 'Dados Pessoais Inválidos',
        self::DIVERGENT_ADDRESS => 'Endereço Divergente',
        self::FRAUD_IN_HISTORY_FCONTROL => 'Histórico De Fraude No FControl',
        self::TRANSACTION_HISTORY_IN_LOSS_RECOVERY => 'Historico de Transação Em Recuperação de Perdas',
        self::IN_TRANSACTIONS_HISTORY_SUSPENDED_IN_FCONTROL => 'Histórico De Transações Suspensas No FControl',
        self::DIVERGENT_PHONE => 'Telefone Divergente',
        self::PHONE_INVALID => 'Telefone Inválido',
        self::SELF_FRAUD_FINANCIAL_LOSS => 'Auto-Fraude com Perda Financeira',
        self::SELF_FRAUD_WITHOUT_FINANCIAL_LOSS => 'Auto-Fraude sem Perda Financeira',
        self::BUYER_NOT_RECOGNIZED_TRANSACTION_WITH_FINANCIAL_LOSS => 'Comprador Não Reconhece Transação com Perda Financeira',
        self::BUYER_ACKNOWLEDGES_NOT_WITHOUT_TRANSACTION_FINANCIAL_LOSS => 'Comprador Não Reconhece Transação sem Perda Financeira',
        self::FROM_IDENTITY_FRAUD => 'Fraude De Identidade',
        self::RELATED_FRAUD_FINANCIAL_LOSS => 'Fraudes Vinculadas com Perda Financeira',
        self::RELATED_FRAUD_WITHOUT_FINANCIAL_LOSS => 'Fraudes Vinculadas sem Perda Financeira',
        self::HOLDER_CARD_NOT_RECOGNIZED_TRANSACTION_WITH_FINANCIAL_LOSS => 'Titular Do Cartão Não Reconhece Transação com Perda Financeira',
        self::HOLDER_CARD_NOT_RECOGNIZED_TRANSACTION_WITHOUT_FINANCIAL_LOSS => 'Titular Do Cartão Não Reconhece Transação sem Perda Financeira',
    );
    protected $isConstantName = false;

    /**
     * @param string $input
     */
    public function __construct($input)
    {
        $this->check($input);
        $this->name = $this->translate($input);
        $this->code = $this->getCodeFromName($this->getName());
    }

    /**
     * @param int|string $input
     * @return string
     */
    protected function translate($input)
    {
        if ($this->isConstantName) {
            $input = constant(__CLASS__ . '::' . strtoupper($input));
        }
        if ($this->isValidCode($input)) {
            $input = $this->getNameFromCode($input);
        }
        return $input;
    }

    /**
     * @param string $input
     * @return void
     * @throws \FControl\Exceptions\ReasonNotFound
     */
    protected function check($input)
    {
        $ref = new \ReflectionClass($this);
        $constants = $ref->getConstants();

        $this->isConstantName = isset($constants[mb_strtoupper($input)]);
        $hasSameValue = in_array($input, $constants);

        if (!$this->isConstantName && !$hasSameValue && !$this->isValidCode($input)) {
            throw new ReasonNotFound($input);
        }
    }

    public function jsonSerialize()
    {
        return $this->getName();
    }
}
