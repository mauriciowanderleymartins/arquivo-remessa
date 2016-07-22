<?php

use Morrice\Remessa\Complemento\Segments;

/**
 * Description of BatchService
 *
 * @author Morrice256 <mauriciowanderleymartins@gmail.com>
 * @github https://github.com/morrice256/
 */
class SegmentsTypeTest extends PHPUnit_Framework_TestCase{

  public function testSegmentType()
  {      
      $segment = [ 
            'BANCO' => '001',
            'AGENCIA' => '912',
            'DVAGENCIA' => '2',
            'CONTA' => '45646',
            'DVCONTA' => '2',
            'TIPO_CONTA' => 'CORRENTE',
            'FAVORECIDO' => 'JOSE FRANCISCO',
            'CODIGO' => '9056',
            'VALOR' => '23,90',
            'MOVIMENTO' => 'INCLUSAO',
            'TIPO' => 'CPF',
            'DOCUMENTO' => '278.617.778-20',
            'ENDERECO'  => [
                  'LOGRADOURO'    => 'Rua Jurema Antão',
                  'NUMERO'        => '69',
                  'COMPLEMENTO'   => '',
                  'CIDADE'        => 'Pau Amarelo',
                  'BAIRRO'        => 'Jiquia',
                  'CEP'           => '50000-000',
                  'UF'            => 'DF',
                      ],
                   ];

      $segments = new Segments();
      $this->assertTrue( true );
  }

//    /**
//     * @expectedException Morrice\Remessa\Exceptions\InvalidSegmentException
//     */
//  public function testExceptionSegmentType()
//  {
//      $segment = [ 
//            'BANCO' => '034',
//            'AGENCIA' => '34',
//            'DVAGENCIA' => '7',
//            'CONTA' => '23',
//            'DVCONTA' => '9',
//            'TIPO_CONTA' => 'CORRENTE',
//            'FAVORECIDO' => 'JOSÉ SÃO FRANCISCO SILVA',
//            'CODIGO' => '34',
//            'VALOR' => '1.090,90',
//            'MOVIMENTO' => 'INCLUSAO',
//            'TIPO' => 'CNPJ',
//            'DOCUMENTO' => '14.771.421/0001-20'];
//
//      $segments = new Segments();
//      $segments->valide($segment);
//
//  }
        
}

