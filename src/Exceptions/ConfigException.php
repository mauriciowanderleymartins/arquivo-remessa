<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of OperacaoException
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class ConfigException extends \Exception {

    public function __construct() {

        $this->message = "CONFIGURAÇÃO NÃO IMPLEMENTADA";
        
    }
    
}
