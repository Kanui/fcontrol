<?php

namespace FControl\Parameter;

/**
 * Class Address
 * @package FControl\Parameter
 */
class Document extends AbstractEnumerator
{
    /**
     * Document not received.
     */
    const NONE = 0;
    /**
     * Individual Brazilian Document.
     */
    const CPF = 1;
    /**
     * Legal Entity Brazilian Document
     */
    const CNPJ = 2;
    /**
     * Individual Argentina Document
     */
    const DNI = 3;
    /**
     * Legal Entity Argentina Document
     */
    const CUIT = 4;
    /**
     * Individual or Legal Entity Mexican Document
     */
    const RFC = 5;
    /**
     * Individual or Legal Entity Venezuelan Document
     */
    const RIF = 6;
    /**
     * Individual or Legal Entity Colombian Document
     */
    const RUC = 7;

    protected $parameters = array(
        'Tipo' => null,
        'SiglaPais' => null,
        'Numero' => null,
    );

    protected $codeNames = array(
        Document::NONE => 'Não Informado',
        Document::CPF => 'CPF',
        Document::CNPJ => 'CNPJ',
        Document::DNI => 'DNI',
        Document::CUIT => 'CUIT',
        Document::RFC => 'RFC',
        Document::RIF => 'RIF',
        Document::RUC => 'RUC',
    );

    /**
     * @param int $type
     * @param $country
     * @param $number
     */
    public function __construct($type, $country, $number)
    {
        $this->check($type);
        $this->Tipo = $this->translate($type);
        $this->SiglaPais = $country;
        $this->Numero = preg_replace('/[^\d]/', '', $number);
    }

    public function jsonSerialize()
    {
        return $this->parameters;
    }
}
