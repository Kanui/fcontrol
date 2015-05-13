<?php

namespace FControl\Tests\Parameter;

use FControl\Parameter\Authentication;
use FControl\Parameter\Product;
use FControl\Tests\Providers\Order as ProviderOrder;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Because Provider Order generate a dynamic data,
     * it needs to replace some data to get successful result.
     */
    public function testIWantToConvertOrderToArrayAndExpectSuccessfullResult()
    {
        $orderProvider = new ProviderOrder();
        $orderProvider->setAuthentication(new Authentication('username', 'password'));
        $orderProvider->setTest();
        $orderProvider->CodigoPedido = 3403;
        $orderProvider->DataCompra = new \DateTime('2015-03-27 11:32:36');
        $orderProvider->DadosComprador->NomeComprador = 'Tester Provider 58';
        $orderProvider->DadosComprador->Endereco->Cep = '92951121';
        $orderProvider->DadosComprador->NumeroTelefone = '976731695';
        $orderProvider->DadosComprador->NumeroCelular = '930338600';
        $orderProvider->DadosComprador->Email = 'test58@provider.com';
        $orderProvider->DadosComprador->DataNascimento = new \DateTime('1994-03-27');
        $orderProvider->DadosEntrega->Endereco->Cep = '94099198';
        $orderProvider->DadosEntrega->NumeroTelefone = '998741236';
        $orderProvider->DadosEntrega->NumeroCelular = '918630985';
        /** @var Product $product */
        foreach($orderProvider->Produtos as $product){
            $product->Codigo = 'CXPL4433';
            $product->Descricao = 'Product Test - 4433';
        }
        $this->assertEquals($this->orderArray(), $orderProvider->toArray());
    }

    protected function orderArray()
    {
        return array(
            'DadosUsuario' => array('Login' => 'username', 'Senha' => 'password',),
            'DadosComprador' => array(
                'Codigo' => 123,
                'DataCadastro' => '2013-08-23',
                'NomeComprador' => 'Tester Provider 58',
                'Endereco' => array(
                    'Pais' => 'BRA',
                    'Cep' => '92951121',
                    'Rua' => 'Test Street',
                    'Numero' => 200,
                    'Complemento' => null,
                    'Bairro' => 'Neighborhood',
                    'Cidade' => 'City',
                    'Estado' => 'State',
                ),
                'CpfCnpj' => '29491430084',
                'DddTelefone' => '41',
                'NumeroTelefone' => '976731695',
                'DddCelular' => '41',
                'NumeroCelular' => '930338600',
                'IP' => '129.45.133.54',
                'Email' => 'test58@provider.com',
                'Senha' => 'qwerty',
                'Sexo' => 'M',
                'DddTelefone2' => null,
                'NumeroTelefone2' => null,
                'DataNascimento' => '1994-03-27',
            ),
            'DadosEntrega' => array(
                'CpfCnpj' => '29491430084',
                'Sexo' => 'M',
                'DataNascimento' => '1988-04-03',
                'Email' => 'test@provider.com',
                'Endereco' => array(
                    'Pais' => 'BRA',
                    'Cep' => '94099198',
                    'Rua' => 'Test Street',
                    'Numero' => 200,
                    'Complemento' => null,
                    'Bairro' => 'Neighborhood',
                    'Cidade' => 'City',
                    'Estado' => 'State',
                ),
                'DddTelefone' => '41',
                'NumeroTelefone' => '998741236',
                'NomeEntrega' => 'Tester Provider',
                'DddCelular' => '41',
                'NumeroCelular' => '918630985',
                'DddTelefone2' => null,
                'NumeroTelefone2' => null,
            ),
            'Pagamentos' => array(
                'WsPagamento2' => array(
                    0 => array(
                        'MetodoPagamento' => 'CartaoMasterCard',
                        'Cartao' => array(
                            'NomeBancoEmissor' => null,
                            'NumeroCartao' => 'e1631b920344398d7bb4f62b6a3e158801a2b04b7217ca6ec0fcfcc5ff13b53a',
                            'DataValidadeCartao' => '02/2016',
                            'NomeTitularCartao' => 'TESTER PROVIDER',
                            'CpfTitularCartao' => null,
                            'Bin' => '123',
                            'quatroUltimosDigitosCartao' => '2135',
                            'BinBandeira' => 'VISA',
                            'BinBanco' => null,
                            'BinPais' => 55,
                            'DddTelefone2' => null,
                            'NumeroTelefone2' => null,
                        ),
                        'Valor' => 50,
                        'NumeroParcelas' => 1,
                        'Nsu' => 143,
                    ),
                ),
            ),
            'CodigoPedido' => 3403,
            'CodigoPedido2' => null,
            'DataCompra' => '2015-03-27T11:32:36',
            'DataEntrega' => '2013-08-29T00:00:00',
            'QuantidadeItensDistintos' => 1,
            'QuantidadeTotalItens' => 1,
            'ValorTotalCompra' => 5000,
            'ValorTotalFrete' => 0,
            'PedidoDeTeste' => true,
            'PrazoEntregaDias' => 576,
            'FormaEntrega' => 'Sedex',
            'Observacao' => null,
            'CanalVenda' => 'Internet',
            'Produtos' => array(
                'WsProduto3' => array(
                    0 => array(
                        'Codigo' => 'CXPL4433',
                        'Descricao' => 'Product Test - 4433',
                        'Quantidade' => 1,
                        'ValorUnitario' => 5000,
                        'Categoria' => 'Decoracao',
                        'ListaDeCasamento' => false,
                        'ParaPresente' => false,
                    ),
                ),
            ),
            'DadosExtra' => array(
                'Extra1' => null,
                'Extra2' => null,
                'Extra3' => null,
                'Extra4' => null,
            ),
            'StatusFinalizador' => 'Pendente',
            'CodigoIntegrador' => true,
        );
    }
}
