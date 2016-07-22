<?php

namespace Morrice\Remessa;

use Morrice\Remessa\ConstantsOperacao;
use Morrice\Remessa\ConstantsRegistro;
use Exceptions\ConfigException;
use Illuminate\Config\Repository as Config;
use Morrice\Remessa\Complemento\Endereco;
use Complemento\Segmento;

/**
 * Description of Layout
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */

abstract class Layout {
    
    protected $lot_number;
    protected $operacao;
    protected $servico;
    protected $lancamento;
    protected $versao_layout;
    protected $pessoa;
    protected $documento;    
    protected $convenio;
    protected $conta;
    protected $agencia;
    protected $dvconta;
    protected $dvagencia;
    protected $empresa;
    protected $banco;
    protected $arquivo;
    protected $total_lot = 0;
    
    protected $endereco;
    protected $config;    
    public $pathfile;
    
    protected $headerfile;
    protected $headerlot;
    protected $segments = array();
    protected $trailerlot;
    protected $trailerfile;
    
    public function __construct() {
        
        $this->config = new Config(   include(__DIR__ . '/config/remetente.php')  );
        $this->convenio = $this->complet_number( $this->config->get('CONVENIO'), 20);
        $this->agencia = $this->complet_number( $this->config->get('AGENCIA'), 5);
        $this->dvagencia = $this->config->get('DV-AGENCIA');
        $this->conta = $this->complet_number( $this->config->get('CONTA'), 12);
        $this->dvconta = $this->config->get('DV-CONTA');
        $this->empresa = $this->complet_string($this->config->get('EMPRESA'), 30);
        $this->banco = $this->complet_string($this->config->get('BANCO'), 30);
        $this->endereco = new Endereco( $this->config->get('ENDERECO') );
        $this->pathfile = $this->config->get('FOLDER') ;
        
    }

    protected function set_lot_number($lot_number){        
        $this->lot_number = $this->complet_number($lot_number, 4);        
    }
    
    protected function set_arquivo($arquivo){
        $this->arquivo = $this->complet_number($arquivo, 6);
    }
    
    protected function set_pessoa($pessoa){

        try{
            $tipo = $this->config->get($pessoa);
            $this->pessoa = $tipo['TIPO'];
            $documento = $this->remove_caracteres($tipo['DOCUMENTO']);
            $this->documento = $this->complet_number($documento, 14);
            
        } catch (ConfigException $ex) {
            throw new ConfigException();
        }
        
    }
            
    protected function complet_number($number, $size){
        
        $number = trim($number);
        $number = str_pad($number, $size, '0', STR_PAD_LEFT);
        return $number;
        
    }
    
    protected function complet_string($string, $size, $value = " "){
        
        $string = trim($string);
        $string = str_pad($string, $size, $value, STR_PAD_LEFT);
        return $string;
        
    }
    
    protected function remove_caracteres($string){
        
        $string = trim($string);
        $string = preg_replace('/[^A-Za-z0-9]/', '', $string);
        return $string;
        
    }
    
    protected function remove_especiais($string){
        
        /**
         * MUITO CARA DE GAMBIARRA, SE ALGUM SOUBER UMA FORMA DE TROCAR ACENTOS
         * FAVOR INFORMAR OU SUBISTITUIR
         */
        $search = explode(",",
"ç,æ,œ,á,é,í,ó,õ,ú,à,è,ì,ò,ù,ã,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,Ã,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
	$replace = explode(",",
"c,ae,oe,a,e,i,o,o,u,a,e,i,o,u,a,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");
	$string = str_replace($search, $replace, $string);
        
        return $string;
        
    }

    public function get_lot_number() {
        return $this->lot_number;
    }
    
    public function get_headerlot() {
        return $this->headerlot;
    }
    
    public function get_headerfile() {
        return $this->headerfile;
    }       
    
    public function get_segments($segment = null, $numero = null) {
        
        $return = $this->segments;
        
        if($segment)
            $return = $this->segments[$numero];
        
        return $return;
    }       
    
    public function get_camara_centralizadora($bancoremetente, $bancofavorecido) {
        
        if($bancoremetente == $bancofavorecido)
            return Constants::CAMADA_TED;
        
        return Constants::CAMADA_DOC;
    }  

    public function get_trailerlot() {
        return $this->trailerlot;
    }       
    
    public function get_trailerfile() {
        return $this->trailerfile;
    }       
    
    
}
