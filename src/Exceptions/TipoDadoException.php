<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of OperacaoException
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class TipoDadoException extends \Exception {

    public function __construct() {

        $this->message = "TIPO DE DADOS NÃO PERMITIDO";
        
    }
    
}
