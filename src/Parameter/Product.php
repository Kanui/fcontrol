<?php

namespace FControl\Parameter;

class Product extends AbstractParameter
{
    protected $parameters = array(
        'Codigo' => null,
        'Descricao' => null,
        'Quantidade' => null,
        'ValorUnitario' => null,
        'Categoria' => null,
        'ListaDeCasamento' => false,
        'ParaPresente' => false,
    );

    /**
     * @param string $id
     * @param string $description
     * @param int $quantity
     * @param float $unitPrice
     * @param string $category
     * @param bool $weddingList
     */
    public function __construct($id, $description, $quantity, $unitPrice, $category, $weddingList = false, $isGift = false)
    {
        $this->Codigo = $id;
        $this->Descricao = $description;
        $this->Quantidade = $quantity;
        $this->ValorUnitario = $unitPrice * 100;
        $this->Categoria = $category;
        $this->ListaDeCasamento = $weddingList;
        $this->ParaPresente = $isGift;
    }

    public function getUnitPrice()
    {
        return $this->ValorUnitario / 100;
    }
}
