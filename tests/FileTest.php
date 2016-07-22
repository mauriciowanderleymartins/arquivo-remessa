<?php

use Morrice\Remessa\LayoutBancoBrasil;
use Carbon\Carbon;

/**
 * Description of LayoutTest
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class FileTest extends PHPUnit_Framework_TestCase{

  public function testFile()
  {
      
      $agora = Carbon::now()->format("dmYHis");
      $data = Carbon::now()->format("dmY");

      $pagamento1 = [ 
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

      $pagamento2 = [ 
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

      $headerfile = "00100101         2312561350001469999999999999999999900345400000002334540                   TESTE DRIVE               BANCO DO BRASIL          1{$agora}000001084                                                                          ";
      $headerlot = "00100101R9801084 2312561350001469999999999999999999900345400000002334540                   TESTE DRIVE                                                   Rua Pindamonhangaba00069                        Pau Amarelo50000000DF                  ";
      $string1 ="0010010300001A00101800100912200000004564622                JOSE FRANCISCO                9056{$data}BRL000000000000001000000000002390                    00000000000000000000000                                        980000000              ";
      $string2 = "0010010300002A00170003400034700000000002399      JOSE SAO FRANCISCO SILVA                  34{$data}BRL000000000000001000000000109090                    00000000000000000000000                                        980000000              ";            
      $string1B ="0010010300001B   100027861777820              Rua Jurema Antao00069                        Jiquia         Pau Amarelo50000000DF{$data}000000000002390000000000000000000000000000000000000000000000000000000000000           90560              ";
      $string2B ="0010010300002B   214771421000120                  Rua Sao Joao00902                 Santo Antonio              Jurere50000000DF{$data}000000000109090000000000000000000000000000000000000000000000000000000000000             340              ";
      $trailerlot ="00100105         000002000000000000111480000000000000000001000000                                                                                                                                                                               ";
      $trailerfile ="00100109         000001000002000001                                                                                                                                                                                                             ";

      $filemount = $headerfile."\n".$headerlot."\n".$string1."\n".$string2."\n".$string1B."\n".$string2B."\n".$trailerlot."\n".$trailerfile."\n";
      
      $layout = new LayoutBancoBrasil(10, "JURIDICO", 1, 'REMESSA', 'PAGAMENTO_DIVERSOS', 'CONTA_CORRENTE');
      $layout->add_segment($pagamento1);
      $layout->add_segment($pagamento2);
      $layout->load_trailerlot();
      $layout->load_trailerfile();
      
      $filepath = $layout->mount_file();

      $filename = "/storage/remessa/0010010" . Carbon::now()->format("dmYHis") . ".txt";      
      
//      $this->assertEquals($filename, $filepath);
      
      //$filefunction = file_get_contents( $filename );
      
      //$this->assertEquals($filemount, $filefunction);

  }        
}

