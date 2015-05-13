<?php

namespace FControl\Parameter;

/**
 * @package FControl\Parameter
 */
class Risk extends AbstractEnumerator
{
    const LOW = 0;
    const MEDIUM = 1;
    const HIGH = 3;
    const CRITIC = 2;

    protected $codeNames = array(
        Risk::LOW => 'Risco Baixo',
        Risk::MEDIUM => 'Risco Médio',
        Risk::HIGH => 'Risco Alto',
        Risk::CRITIC => 'Risco Crítico',
    );

    public function jsonSerialize()
    {
        return $this->getCode();
    }
}
