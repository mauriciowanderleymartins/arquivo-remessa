<?php

use Morrice\Remessa\Complemento\Endereco;

/**
 * Description of LayoutTest
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class EnderecoTest extends PHPUnit_Framework_TestCase{

  public function testEndereco()
  {
      $dados =['LOGRADOURO'    => 'Rua Pindamonhãgaba',
                'NUMERO'        => '69',
                'COMPLEMENTE'   => '',
                'CIDADE'        => 'Pau Amarelo',
                'CEP'           => '50000-000',
                'UF'            => 'DF'];
      
      $endereco = new Endereco($dados);
      $this->assertEquals('Rua Pindamonhagaba', $endereco->logradouro);
      $this->assertEquals('69', $endereco->numero);
      $this->assertEquals('', $endereco->complemento);
      $this->assertEquals('Pau Amarelo', $endereco->cidade);
      $this->assertEquals('50000000', $endereco->cep);
      $this->assertEquals('DF', $endereco->uf);

  }
    
    /**
     * @expectedException Morrice\Remessa\Exceptions\TipoDadoException
     */
  public function testExceptionTipoDado()
  {
      $endereco = new Endereco("Rua Jiquia");
  }
        
}

