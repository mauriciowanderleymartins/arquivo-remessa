<?php

namespace Morrice\Remessa;

use Morrice\Remessa\Constants;
use Carbon\Carbon;

/**
 * Description of Layout
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class LayoutBancoBrasil extends Layout{
    
    const BANCO         =   "001";
    const VERSAO_LAYOUT =   "084";
    
    public function __construct($lote, $pessoa, $arquivo, $operacao, $servico, $lancamento) {

        parent::__construct();
        
        $this->set_lot_number($lote);
        $this->set_pessoa($pessoa);
        $this->set_arquivo($arquivo);
        $this->operacao = $operacao;
        $this->lancamento = $lancamento;
        $this->servico = $servico;
        
        $this->generate_headerlot();        
        $this->generate_headerfile();

    }

    private function generate_headerfile(){
        
        /*Codigo Campo*/
        /*1*/$header = LayoutBancoBrasil::BANCO;
        /*2*/$header .= $this->lot_number;
        /*3*/$header .= Constants::HEADERLOT;
        /*4*/$header .= $this->complet_string("", 9);
        
        /*5*/$header .= $this->pessoa;
        /*6*/$header .= $this->documento;
        /*7*/$header .= $this->convenio;
        /*8*/$header .= $this->agencia;
        /*9*/$header .= $this->dvagencia;
        /*10*/$header .= $this->conta;
        /*11*/$header .= $this->dvconta;
        /*12*/$header .= "0";
        /*13*/$header .= $this->empresa;
        /*14*/$header .= $this->banco;
        /*15*/$header .= $this->complet_string("", 10);
        /*16*/$header .= "1";
        /*17*/$header .= Carbon::now()->format("dmY");
        /*18*/$header .= Carbon::now()->format("His");
        /*19*/$header .= $this->arquivo;
        /*20*/$header .= LayoutBancoBrasil::VERSAO_LAYOUT;
        /*21*/$header .= $this->complet_string("", 5);
        /*22*/$header .= $this->complet_string("", 20);
        /*23*/$header .= $this->complet_string("", 20);
        /*24*/$header .= $this->complet_string("", 29);
        
        $this->headerfile = $header;
    }
    
    private function generate_headerlot(){

        /*Codigo Campo*/
        /*1*/$header =  LayoutBancoBrasil::BANCO;
        /*2*/$header .= $this->lot_number;
        /*3*/$header .= Constants::HEADERLOT;
        /*4*/$header .= Constants::get_operacao($this->operacao);        
        /*5*/$header .= Constants::get_servico($this->servico);
        /*6*/$header .= Constants::get_lancamento($this->lancamento);
        /*7*/$header .= LayoutBancoBrasil::VERSAO_LAYOUT;
        /*8*/$header .= " ";
        /*9*/$header .= $this->pessoa;
        /*10*/$header .= $this->documento;
        /*11*/$header .= $this->convenio;
        /*12*/$header .= $this->agencia;
        /*13*/$header .= $this->dvagencia;
        /*14*/$header .= $this->conta;
        /*15*/$header .= $this->dvconta;
        /*16*/$header .= "0";
        /*17*/$header .= $this->empresa;
        /*18*/$header .= $this->complet_string("", 40);
        /*19*/$header .= $this->complet_string( $this->endereco->logradouro , 30);
        /*20*/$header .= $this->complet_number( $this->endereco->numero , 5);
        /*21*/$header .= $this->complet_string( $this->endereco->complemento , 15);
        /*22*/$header .= $this->complet_string( $this->endereco->cidade , 20);
        /*23-24*/$header .= $this->complet_string( $this->endereco->cep , 8);
        /*25*/$header .= $this->endereco->uf;
        /*26*/$header .= $this->complet_string( "" , 2);
        /*27*/$header .= $this->complet_string( "" , 6);
        /*28*/$header .= $this->complet_string( "" , 10);
        
        $this->headerlot = $header;
        
    }
    
    private function generate_trailerlot(){
        
        /*Codigo Campo*/
        /*1*/$header =  LayoutBancoBrasil::BANCO;
        /*2*/$header .= $this->lot_number;
        /*3*/$header .= Constants::TRAILERLOT;
        /*4*/$header .= $this->complet_string("", 9);
        /*5*/$header .= $this->complet_number( count($this->segments), 6);
        /*6*/$header .= $this->complet_number( $this->total_lot, 18);
        /*7*/$header .= $this->complet_number( 1, 18);
        /*8*/$header .= $this->complet_number( 0, 6);
        /*9*/$header .= $this->complet_string( "", 165);
        /*9*/$header .= $this->complet_string( "", 10);
        $this->trailerlot = $header;
        
    }
    
    private function generate_trailerfile(){
        
        /*Codigo Campo*/
        /*1*/$header = LayoutBancoBrasil::BANCO;
        /*2*/$header .= $this->lot_number;
        /*3*/$header .= Constants::TRAILERFILE;
        /*4*/$header .= $this->complet_string(" ", 9);
        /*5*/$header .= $this->complet_number(1, 6);
        /*6*/$header .= $this->complet_number(count($this->segments) , 6);
        /*7*/$header .= $this->complet_number(1, 6);
        /*8*/$header .= $this->complet_string(" ", 205);
        
        $this->trailerfile = $header;
        
    }

    private function generate_file(){
        
        $filename = LayoutBancoBrasil::BANCO . "" .$this->lot_number . "" . Carbon::now()->format("dmYHis") . ".txt";
        
        if(!file_exists($this->pathfile)){
            
            mkdir($this->pathfile, 0777, true);
            
        }
        
        $file = fopen($_SERVER['DOCUMENT_ROOT'] . $this->pathfile . $filename,"wb");
        fwrite($file, $this->headerfile."\n");
        fwrite($file, $this->headerlot."\n");
        
        foreach ($this->segments as $segment){
            
            fwrite($file, $segment['A']."\n");
            fwrite($file, $segment['B']."\n");
            
        }
        
        fwrite($file, $this->trailerlot."\n");
        fwrite($file, $this->trailerfile."\n");        
        fclose($file);
        
        return $file;
        
    }

    private function add_segmentA(Array $segment){
        
         /*Codigo Campo*/
        /*1*/$headerA = LayoutBancoBrasil::BANCO;
        /*2*/$headerA .= $this->lot_number;
        /*3*/$headerA .= Constants::DETAILS;
        /*4*/$headerA .= $this->complet_number( (count($this->segments) + 1), 5);
        /*5*/$headerA .= "A";
        /*6*/$headerA .= Constants::get_movimento($segment['MOVIMENTO']);
        /*7*/$headerA .= "01";
        /*8*/$headerA .= $this->get_camara_centralizadora(LayoutBancoBrasil::BANCO, $segment['BANCO']);
        /*9*/$headerA .= $this->complet_number( $segment['BANCO'], 3 );
        /*10*/$headerA .= $this->complet_number( $segment['AGENCIA'], 5 );
        /*11*/$headerA .= $this->complet_number( $segment['DVAGENCIA'], 1);
        /*12*/$headerA .= $this->complet_number( $segment['CONTA'], 12 );
        /*13*/$headerA .= $this->complet_number( $segment['DVCONTA'], 1 );
        /*14*/$headerA .= $this->complet_number( $segment['DVCONTA'], 1 );
        /*15*/$headerA .= $this->complet_string( $this->remove_especiais( $segment['FAVORECIDO']), 30);
        /*16*/$headerA .= $this->complet_string( $segment['CODIGO'], 20);
        /*17*/$headerA .= Carbon::now()->format("dmY");
        /*18*/$headerA .= "BRL";
        /*19*/$headerA .= $this->complet_number( 1, 15);
        /*20*/$headerA .= $this->complet_number( $this->remove_caracteres( $segment['VALOR'] ), 15);
        /*21*/$headerA .= $this->complet_string( "", 20);
        /*22*/$headerA .= $this->complet_number( 0, 8);
        /*23*/$headerA .= $this->complet_number( 0, 15);
        /*24*/$headerA .= $this->complet_string( "", 40);
        /*25*/$headerA .= Constants::get_servico( $this->servico );
        /*26*/$headerA .= "00000";
        /*27*/$headerA .= "00";
        /*28*/$headerA .= $this->complet_string("", 3);
        /*29*/$headerA .= $this->complet_string("", 11);
        
        $valor = $this->remove_caracteres($segment['VALOR']);
        $this->total_lot += $valor;
        
        return $headerA;
        
    }
        
    private function add_segmentB(Array $segment){
        
        /*Codigo Campo*/
        /*1*/$headerB = LayoutBancoBrasil::BANCO;
        /*2*/$headerB .= $this->lot_number;
        /*3*/$headerB .= Constants::DETAILS;
        /*4*/$headerB .= $this->complet_number( (count($this->segments) + 1), 5);
        /*5*/$headerB .= "B";      
        /*6*/$headerB .= $this->complet_string("", 3);
        /*7*/$headerB .= Constants::get_documento($segment['TIPO']);
        /*8*/$headerB .= $this->complet_number($this->remove_caracteres($segment['DOCUMENTO']), 14) ;
        /*9*/$headerB .= $this->complet_string($this->remove_especiais($segment['ENDERECO']['LOGRADOURO']), 30);
        /*10*/$headerB .= $this->complet_number( $segment['ENDERECO']['NUMERO'], 5);
        /*11*/$headerB .= $this->complet_string($this->remove_especiais($segment['ENDERECO']['COMPLEMENTO']), 15);
        /*12*/$headerB .= $this->complet_string($this->remove_especiais($segment['ENDERECO']['BAIRRO']), 15);
        /*13*/$headerB .= $this->complet_string($this->remove_especiais($segment['ENDERECO']['CIDADE']), 20);
        /*14-5*/$headerB .= $this->complet_number($this->remove_caracteres($segment['ENDERECO']['CEP']), 5);
        /*16*/$headerB .= $this->complet_string($segment['ENDERECO']['UF'], 2);
        /*17*/$headerB .= Carbon::now()->format("dmY");
        /*18*/$headerB .= $this->complet_number( $this->remove_caracteres( $segment['VALOR'] ), 15);
        /*19*/$headerB .= $this->complet_number( 0, 15);
        /*20*/$headerB .= $this->complet_number( 0, 15);
        /*21*/$headerB .= $this->complet_number( 0, 15);
        /*22*/$headerB .= $this->complet_number( 0, 15);
        /*23*/$headerB .= $this->complet_string( $segment['CODIGO'], 15);        
        /*24*/$headerB .= "0";
        /*25*/$headerB .= $this->complet_string( "", 6);
        /*26*/$headerB .= $this->complet_string( "", 8);        
        
        return $headerB;
        
    }       

    public function add_segment(Array $segment){
                  
        $objSegments = new Complemento\Segments();
        $objSegments->valide($segment);
        
        $header['A'] = $this->add_segmentA($segment);
        $header['B'] = $this->add_segmentB($segment);
        
        array_push($this->segments, $header);
        
    }    

    public function load_trailerlot(){
        
        $this->generate_trailerlot();
        
    }    
    
    public function load_trailerfile(){
        
        $this->generate_trailerfile();
        
    }    

    public function mount_file(){
        
        $filepath = $this->generate_file();
        return $filepath;
        
    }    

}
