<?php

namespace Morrice\Remessa\Complemento;

use Morrice\Remessa\Exceptions\InvalidSegmentException;

/**
 * Description of BatchService
 *
 * @author Morrice256 <mauriciowanderleymartins@gmail.com>
 * @github https://github.com/morrice256/
 */
class Segments {

    private $list_keys = ["BANCO", "AGENCIA", "DVAGENCIA",  "CONTA", "DVCONTA", "TIPO_CONTA", "FAVORECIDO",
            "CODIGO", "VALOR",  "MOVIMENTO",  "TIPO", "DOCUMENTO", "ENDERECO"]; 
    private $list_keys_adress = ['LOGRADOURO', 'NUMERO', 'COMPLEMENTO', 'CIDADE', 'BAIRRO', 'CEP', 'UF'];

    private $segments;
    
    public function valide($segments){
        $this->segments = $segments;
        $this->validation_atributes();
        return true;
    }

    private function validation_atributes(){

        $segments = $this->segments;
        
        foreach ($this->list_keys as $value){ 
            if(!array_key_exists($value, $segments)){
                throw new InvalidSegmentException();
            }            
        }

        foreach ($this->list_keys_adress as $value){            
            if(!array_key_exists($value, $segments['ENDERECO'])){
                throw new InvalidSegmentException();
            }            
        }
    }
    
//    private function validation_atributes_types(){
//
//        $segments = $this->segments;
//
//        /**
//         * Passar por todos os segmentos e verificar se cada um tem os tipos de dados corretos
//         */
//
//    }
    
}
