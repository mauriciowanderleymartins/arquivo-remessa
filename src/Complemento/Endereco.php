<?php

namespace Morrice\Remessa\Complemento;

use Morrice\Remessa\Exceptions\TipoDadoException;
/**
 * Description of Endereco
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class Endereco {

    public $logradouro = "";
    public $numero = "";
    public $complemento = "";
    public $cidade = "";
    public $cep = "";
    public $uf = "";

    public function __construct($dados) {
        
        if(!is_array($dados)){
            throw new TipoDadoException();
        }
        
        foreach ($dados as $key => $dado){
            $dados[$key] = $this->remove_caracteres($dado);
        }
        
        if(array_key_exists("LOGRADOURO", $dados)){
            $this->logradouro = $dados['LOGRADOURO'];
        }
        
        if(array_key_exists("NUMERO", $dados)){
            $this->numero = $dados['NUMERO'];
        }
        
        if(array_key_exists("COMPLEMENTE", $dados)){
            $this->complemento = $dados['COMPLEMENTE'];
        }
        
        if(array_key_exists("CIDADE", $dados)){
            $this->cidade = $dados['CIDADE'];
        }
        
        if(array_key_exists("CEP", $dados)){
            $this->cep = $dados['CEP'];
        }
        
        if(array_key_exists("UF", $dados)){
            $this->uf = $dados['UF'];
        }                
    }
        
    protected function remove_caracteres($string){
        
        /**
         * MUITO CARA DE GAMBIARRA, SE ALGUM SOUBER UMA FORMA DE TROCAR ACENTOS
         * FAVOR INFORMAR OU SUBISTITUIR
         */
        $conversao = array('á' => 'a','à' => 'a','ã' => 'a','â' => 'a', 'é' => 'e',
                   'ê' => 'e', 'í' => 'i', 'ï'=>'i', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', "ö"=>"o",
                   'ú' => 'u', 'ü' => 'u', 'ç' => 'c', 'ñ'=>'n', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A',
                   'Â' => 'A', 'É' => 'E', 'Ê' => 'E', 'Í' => 'I', 'Ï'=>'I', "Ö"=>"O", 'Ó' => 'O',
                   'Ô' => 'O', 'Õ' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ç' =>'C', 'N'=>'Ñ');
        $string = strtr($string, $conversao);
        $string = preg_replace('/[^A-Za-z0-9 ]/', '', $string);
        
        return $string;
        
    }
    
}
