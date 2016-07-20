<?php

namespace Morrice\Remessa;

use Morrice\Remessa\Exceptions\OperacaoException;
use Morrice\Remessa\Exceptions\LancamentoException;
use Morrice\Remessa\Exceptions\ServicoException;
use Morrice\Remessa\Exceptions\MovimentoException;

/**
 * Description of Constants
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class Constants{
    
    const HEADERFILE =    "0";
    const HEADERLOT =     "1";
    const STARTLOT =      "2";
    const DETAILS =       "3";
    const ENDLOT =        "4";
    const TRAILERLOT =    "5";
    const TRAILERFILE =   "9";
    
    const CAMADA_TED =    "018"; 
    const CAMADA_DOC =    "700";
    
    public static function get_operacao($operacao){
        
        $operacoes = ['CREDITO'     => "C", 
                      'DEBITO'      => "D",
                      'CONCILIACAO' => "E",
                      'GESTAO'      => "G",
                      'INFORMACOES' => "I",
                      'REMESSA'     => "R",
                      'RETORNO'     => "T"];
        
        if(!array_key_exists($operacao, $operacoes))
            throw new OperacaoException();
        
        return $operacoes[$operacao];
    
    }
    
    public static function get_servico($servico){
        
    $servicos =  ['COBRANCA'                => '01',
                  'BLOQUETO'                => '03',
                  'CONCILIACAO'             => '04',
                  'DEBITO'                  => '05',
                  'CUSTODIA_CHEQUE'         => '06',
                  'GESTAO'                  => '07',
                  'CONSULTA'                => '08',
                  'AVERBACAO_RETENCAO'      => '09',
                  'PAGAMENTO_DIVIDENDOS'    => '10',
                  'MANUTENCAO_CONSIGNACAO'  => '11',
                  'CONSIGNACAO_PARCELAS'    => '12',
                  'INSS'                    => '13',
                  'CONSULTA_TRIBUTOS_PAGAR' => '14',
                  'PAGAMENTO_FORNECEDOR'    => '20',
                  'PAGAMENTO_CONTAS'        => '22',
                  'COMPRO'                  => '25',
                  'COMPRO_ROTATIVO'         => '26',
                  'ALEGACAO_SACADO'         => '29',
                  'PAGAMENTO_SALARIO'       => '30',
                  'PAGAMENTO_HONORARIO'     => '32',
                  'PAGAMENTO_AUXILIO'       => '33',
                  'PAGAMENTO_PREBENDA'      => '34',
                  'VENDOR'                  => '40',
                  'VENDOR_TERMO'            => '41',
                  'PAGAMENTO_SINISTRO'          => '50',
                  'PAGAMENTO_DESPESAS_VIAJEM'   => '60',
                  'PAGAMENTO_AUTORIZADO'    => '70',
                  'PAGAMENTO_CREDENCIADO'   => '75',
                  'PAGAMENTO_REMUNERACAO'   => '77',
                  'PAGAMENTO_REPRESENTANTE' => '80',
                  'PAGAMENTO_BENEFICIOS'    => '90',
                  'PAGAMENTO_DIVERSOS'      => '98'];
        
        if(!array_key_exists($servico, $servicos))
            throw new ServicoException();
        
        return $servicos[$servico];
    
    }
    
    public static function get_lancamento($lancamento){
        
    $lancamentos =  ['CONTA_CORRENTE'          => '01',
                     'TED'                     => '03',
                     'DOC'                     => '03',
                     'CONTA_POUPANCA'          => '05',
                     'DEBITO'                  => '50'];
        
        if(!array_key_exists($lancamento, $lancamentos))
            throw new LancamentoException();
        
        return $lancamentos[$lancamento];
    
    }
    
    public static function get_tipo_inscricao($ie){
        
        $operacoes = ['CREDITO'     => "C", 
                      'DEBITO'      => "D",
                      'CONCILIACAO' => "E",
                      'GESTAO'      => "G",
                      'INFORMACOES' => "I",
                      'REMESSA'     => "R",
                      'RETORNO'     => "T"];
        
        if(!array_key_exists($operacao, $operacoes))
            throw new OperacaoException();
        
        return $operacoes[$operacao];
    
    }
    
    public static function get_movimento($movimento){
        
    $movimentos =  ['INCLUSAO'      => '0',
                    'CONSULTA'      => '1',
                    'ESTORNO'       => '3',
                    'ALTERACAO'     => '5',
                    'LIQUIDACAO'    => '7',
                    'EXCLUSAO'      => '9'];
        
        if(!array_key_exists($movimento, $movimentos))
            throw new MovimentoException();
        
        return $movimentos[$movimento];
    
    }
    
    public static function get_documento($documento){
        
    $documentos =  ['CPF'        => '1',
                    'CNPJ'       => '2'];
                
        return $documentos[$documento];
    
    }
    

}
