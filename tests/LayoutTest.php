<?php

use Morrice\Remessa\LayoutBancoBrasil;
use Carbon\Carbon;

/**
 * Description of LayoutTest
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class LayoutTest extends PHPUnit_Framework_TestCase{

  public function testLayout()
  {
      $layout = new LayoutBancoBrasil(10, "JURIDICO", 1, 'REMESSA', 'PAGAMENTO_DIVERSOS', 'CONTA_CORRENTE');
      $agora = Carbon::now()->format("dmYHis");
      $data = Carbon::now()->format("dmY");
      
      $this->assertEquals("00100101         2312561350001469999999999999999999900345400000002334540                   TESTE DRIVE               BANCO DO BRASIL          1{$agora}000001084                                                                          ", $layout->get_headerfile());
      $this->assertEquals(240, strlen($layout->get_headerfile()));
      
      $this->assertEquals("00100101R9801084 2312561350001469999999999999999999900345400000002334540                   TESTE DRIVE                                                   Rua Pindamonhangaba00069                        Pau Amarelo50000000DF                  ", $layout->get_headerlot());
      $this->assertEquals(240, strlen($layout->get_headerlot()));

      $pagamento = [ 
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

      $layout->add_segment($pagamento);      
      $string1 ="0010010300001A00101800100912200000004564622                JOSE FRANCISCO                9056{$data}BRL000000000000001000000000002390                    00000000000000000000000                                        980000000              ";
      $segmentos1 = $layout->get_segments(true, 0);
     
      $this->assertEquals($string1, $segmentos1['A'] );
      $this->assertEquals(240, strlen( $segmentos1['A'] ));
      
      $pagamento = [ 
            'BANCO' => '034',
            'AGENCIA' => '34',
            'DVAGENCIA' => '7',
            'CONTA' => '23',
            'DVCONTA' => '9',
            'TIPO_CONTA' => 'CORRENTE',
            'FAVORECIDO' => 'JOSÉ SÃO FRANCISCO SILVA',
            'CODIGO' => '34',
            'VALOR' => '1.090,90',
            'MOVIMENTO' => 'INCLUSAO',
            'TIPO' => 'CNPJ',
            'DOCUMENTO' => '14.771.421/0001-20',
            'ENDERECO'  => [
                  'LOGRADOURO'    => 'Rua São Jõao',
                  'NUMERO'        => '902',
                  'COMPLEMENTO'   => '',
                  'CIDADE'        => 'Jurere',
                  'BAIRRO'        => 'Santo Antonio',
                  'CEP'           => '50000-000',
                  'UF'            => 'DF',
                      ],
                   ];

      $layout->add_segment($pagamento);
      $string2 = "0010010300002A00170003400034700000000002399      JOSE SAO FRANCISCO SILVA                  34{$data}BRL000000000000001000000000109090                    00000000000000000000000                                        980000000              ";      
      $segmentos2 = $layout->get_segments(true, 1);
      
      $this->assertEquals($string2, $segmentos2['A']);    
      $this->assertEquals(240, strlen( $segmentos2['A'] ));
            
      $string1B ="0010010300001B   100027861777820              Rua Jurema Antao00069                        Jiquia         Pau Amarelo50000000DF{$data}000000000002390000000000000000000000000000000000000000000000000000000000000           90560              ";

      $this->assertEquals($string1B, $segmentos1['B'] );
      $this->assertEquals(240, strlen( $segmentos1['B'] ));
      
      $string2B ="0010010300002B   214771421000120                  Rua Sao Joao00902                 Santo Antonio              Jurere50000000DF{$data}000000000109090000000000000000000000000000000000000000000000000000000000000             340              ";

      $this->assertEquals($string2B, $segmentos2['B'] );
      $this->assertEquals(240, strlen( $segmentos2['B'] ));
            
      $trailerlot ="00100105         000002000000000000111480000000000000000001000000                                                                                                                                                                               ";

      $layout->load_trailerlot();
      $this->assertEquals($trailerlot, $layout->get_trailerlot() );
      $this->assertEquals(240, strlen( $layout->get_trailerlot() ));

      
      $trailerfile ="00100109         000001000002000001                                                                                                                                                                                                             ";

      $layout->load_trailerfile();
      $this->assertEquals($trailerfile, $layout->get_trailerfile() );
      $this->assertEquals(240, strlen( $layout->get_trailerfile() ));

  }

//    /**
//     * @expectedException Morrice\Remessa\Exceptions\OperacaoException
//     */
//  public function testExceptionOperacao()
//  {
//      $layout = new LayoutBancoBrasil(10);
//
//  }
        
}

