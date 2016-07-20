<?php

namespace Morrice\Remessa\Exceptions;

/**
 * Description of OperacaoException
 *
 * @author Morrice <mauriciowanderleymartins@gmail.com>
 */
class MovimentoException extends \Exception {

    public function __construct() {

        $this->message = "MOVIMENTO NÃO IMPLEMENTADO";
        
    }
    
}
